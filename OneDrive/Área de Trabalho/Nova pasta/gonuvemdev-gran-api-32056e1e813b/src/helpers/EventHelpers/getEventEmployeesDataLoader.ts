import Dataloader from 'dataloader';

import { EmployeeDocument, EventDocument } from '../../interfaces';
import { EventEmployeesDataLoader, ID } from '../../types';
import { fetchAllEmployees } from '../../services/EmployeeServices';
import { isIDEqual } from '../../utils/general';

function getEmployeesIdsFromEvents(events: readonly EventDocument[]): ID[] {
  return events.flatMap(({ employees }) => {
    if (employees && employees.length > 0) {
      return employees as ID[];
    }

    return [];
  });
}

function populateEmployees(
  events: readonly EventDocument[],
  employees: EmployeeDocument[],
): EmployeeDocument[][] {
  const findEmployeeById = (id: ID): EmployeeDocument =>
    employees.find(event => isIDEqual(event._id, id)) as EmployeeDocument;

  return events.map(event => {
    if (event.employees && event.employees.length > 0) {
      return (event.employees as ID[]).map(id => findEmployeeById(id));
    }

    return [];
  });
}

async function getEventEmployees(
  events: readonly EventDocument[],
): Promise<EmployeeDocument[][]> {
  const employeesIds = getEmployeesIdsFromEvents(events);

  const employees = await fetchAllEmployees({
    conditions: { _id: { $in: employeesIds } },
  });

  return populateEmployees(events, employees);
}

export function getEventEmployeesDataLoader(): EventEmployeesDataLoader {
  return new Dataloader(getEventEmployees);
}
