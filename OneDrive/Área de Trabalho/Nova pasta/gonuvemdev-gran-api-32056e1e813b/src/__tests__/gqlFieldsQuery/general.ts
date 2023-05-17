export const errorFieldsQuery = `{
  message
  statusCode
  internalCode
  internalError {
    name
    message
    stack
  }
}`;

export const userFieldsQuery = `{
  _id
  name
  email
  roles
}`;

export const addressFieldsQuery = `{
  street
  number
  district
  city
  state
  postalCode
  complement
}`;
