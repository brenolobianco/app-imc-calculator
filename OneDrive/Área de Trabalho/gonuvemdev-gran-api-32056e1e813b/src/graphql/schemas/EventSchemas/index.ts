import * as createEventSchemas from './createEventSchemas';
import * as updateEventSchemas from './updateEventSchemas';
import * as deleteEventSchemas from './deleteEventSchemas';
import * as listEventsSchemas from './listEventsSchemas';
import * as readEventSchemas from './readEventSchemas';

export const types = `
${createEventSchemas.types}
${updateEventSchemas.types}
${deleteEventSchemas.types}
${listEventsSchemas.types}
${readEventSchemas.types}
`;

export const inputs = `
${createEventSchemas.inputs}
${updateEventSchemas.inputs}
`;

export const Query = `
${listEventsSchemas.Query}
${readEventSchemas.Query}
`;

export const Mutation = `
${createEventSchemas.Mutation}
${updateEventSchemas.Mutation}
${deleteEventSchemas.Mutation}
`;
