import Joi from 'joi';
import { ReportDataType } from '../../../enums/ReportDataType';
import {
  GetBusinessStatisticsParams,
  GetReportDataParams,
  JoiSchemaMap,
} from '../../../types';

import {
  arraySchema,
  dateSchema,
  idSchema,
  stringEnumSchema,
} from './baseSchemas';

const getBusinessStatisticsKeys: JoiSchemaMap<GetBusinessStatisticsParams> = {
  beginDate: dateSchema.required(),
  endDate: dateSchema.required(),
  graphBeginDate: dateSchema.optional(),
  graphEndDate: Joi.when('graphBeginDate', {
    is: Joi.exist(),
    then: dateSchema.required(),
    otherwise: dateSchema.forbidden(),
  }),
};

const getBusinessStatisticsSchema = Joi.object().keys(
  getBusinessStatisticsKeys,
);

const getReportDataKeys: JoiSchemaMap<GetReportDataParams> = {
  reportDataType: stringEnumSchema(ReportDataType).required(),
  beginDate: dateSchema.optional(),
  endDate: Joi.when('beginDate', {
    is: Joi.exist(),
    then: dateSchema.required(),
    otherwise: dateSchema.forbidden(),
  }),
  sellersIds: arraySchema(idSchema.required()).optional(),
  productsIds: arraySchema(idSchema.required()).optional(),
  intermediatorsIds: arraySchema(idSchema.required()).optional(),
};

const getReportDataSchema = Joi.object().keys(getReportDataKeys);

export const resolvers = {
  getBusinessStatistics: getBusinessStatisticsSchema,
  getReportData: getReportDataSchema,
};
