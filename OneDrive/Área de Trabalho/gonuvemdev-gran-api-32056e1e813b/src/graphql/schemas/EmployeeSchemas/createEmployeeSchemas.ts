const EmployeeBankAccountType = `
"Conta bancária do funcionário"
type EmployeeBankAccount {
  "Tipo"
  type: String
  "Número"
  number: String
}`;

const EmployeeBankDataType = `
"Dados bancários do funcionário"
type EmployeeBankData {
  "Banco"
  bank: String
  "Agência"
  agency: String
  "Conta"
  account: EmployeeBankAccount
}`;

const AddressType = `
"Endereço"
type Address {
  "Rua/Logradouro"
  street: String
  "Número"
  number: String
  "Bairro"
  district: String
  "Cidade"
  city: String
  "Estado"
  state: String
  "CEP"
  postalCode: String
  "Complemento"
  complement: String
}`;

const EmployeeCTPSType = `
"Carteira de Trabalho e Previdência Social do Funcionário"
type EmployeeCTPS {
  "PIS/PASEP"
  pisPasep: String
  "Número"
  number: String
  "Série"
  series: String
  "UF"
  uf: String
}`;

const EmployeeRelativeType = `
"Parente do Funcionário"
type EmployeeRelative {
  "Parentesco"
  kinship: String
  "Nome"
  name: String
  "Telefone"
  phone: String
  "Data de nascimento"
  dob: Date
}`;

const EmployeeType = `
"Funcionário"
type Employee {
  "Id"
  _id: ID!
  "Nome"
  name: String!
  "Cargo"
  occupation: String!
  "Telefones"
  phones: [String]
  "Dados bancários"
  bankData: EmployeeBankData
  "Email"
  email: String
  "Data de admissão"
  admissionDate: Date
  "Data de nascimento"
  dob: Date
  "RG"
  rg: String
  "Orgão expedidor do RG"
  dispatchingBody: String
  "CPF"
  cpf: String
  "Endereço"
  address: Address
  "Estado civil"
  maritalStatus: String
  "Comissão. Antigo RT (Reserva Técnica)"
  commission: Int
  "Salário"
  salary: Int
  "Carteira de Trabalho e Previdência Social"
  ctps: EmployeeCTPS
  "Escolaridade"
  educationalLevel: String
  "Naturalidade (Local de Nascimento)"
  pob: String
  "Parentes"
  relatives: [EmployeeRelative]
  "Data de criação"
  createdAt: Date!
  "Data de atualização"
  updatedAt: Date!
}
`;

const EmployeeBankAccountInput = `
"Parâmetros do objeto com a conta do funcionário"
input EmployeeBankAccountInput {
  "Tipo. Mínimo: 1 caracter."
  type: String
  "Número. Mínimo: 1 caracter."
  number: String
}
`;

const EmployeeBankDataInput = `
"Parâmetros do objeto com dados bancários do funcionário"
input EmployeeBankDataInput {
  "Banco. Mínimo: 1 caracter."
  bank: String
  "Agência. Mínimo: 1 caracter."
  agency: String
  "Conta. Objeto."
  account: EmployeeBankAccountInput
}
`;

const AddressInput = `
"Parâmetros do objeto Endereço."
input AddressInput {
  "Rua/Logradouro. Máximo: 80 caracteres."
  street: String
  "Número. Máximo: 20 caracteres."
  number: String
  "Bairro. Máximo: 60 caracteres."
  district: String
  "Cidade. Mínimo: 2 caracteres. Máximo: 60 caracteres."
  city: String
  "Estado. Sigla do estado em maiúsculas."
  state: String
  "CEP. String com 8 dígitos."
  postalCode: String
  "Complemento. Máximo: 40 caracteres."
  complement: String
}`;

const EmployeeCTPSInput = `
"Parâmetros do objeto CTPS de Funcionário."
input EmployeeCTPSInput {
  "PIS/PASEP. Mínimo: 1 caracter."
  pisPasep: String
  "Número. Mínimo: 1 caracter."
  number: String
  "Série. Mínimo: 1 caracter."
  series: String
  "UF. Sigla do estado em maiúsculas."
  uf: String
}`;

const EmployeeRelativeInput = `
"Parâmetros do objeto Parente de Funcionário"
input EmployeeRelativeInput {
  "Parentesco. Mínimo: 1 caracter."
  kinship: String!
  "Nome. Mínimo: 1 caracter."
  name: String
  "Telefone. String com 10 ou 11 dígitos."
  phone: String
  "Data de nascimento. Date em ISOString."
  dob: Date
}`;

const CreateEmployeeInput = `
"Parâmetros para cadastro de funcionário"
input CreateEmployeeInput {
  "Nome. Mínimo: 1 caracter."
  name: String!
  "Cargo. Mínimo: 1 caracter."
  occupation: String!
  "Telefones. Array de String de dígitos com tamanho 10 ou 11."
  phones: [String]
  "Dados bancários"
  bankData: EmployeeBankDataInput
  "Email. Formato de email válido."
  email: String
  "Data de admissão. Date em ISOString."
  admissionDate: Date
  "Data de nascimento. Date em ISOString."
  dob: Date
  "RG. Mínimo: 1 caracter."
  rg: String
  "Orgão expedidor do RG. Mínimo 1 caracter."
  dispatchingBody: String
  "CPF. String com 11 dígitos."
  cpf: String
  "Endereço"
  address: AddressInput
  "Estado civil. Mínimo: 1 caracter."
  maritalStatus: String
  "Comissão. Antigo RT (Reserva Técnica). Valor entre 0 (0,00%) e 10000 (100,00%)."
  commission: Int
  "Salário. Valor em centavos. Mínimo: 0."
  salary: Int
  "Carteira de Trabalho e Previdência Social"
  ctps: EmployeeCTPSInput
  "Escolaridade. Mínimo: 1 caracter."
  educationalLevel: String
  "Naturalidade (Local de Nascimento). Mínimo: 1 caracter."
  pob: String
  "Parentes"
  relatives: [EmployeeRelativeInput]
}
`;

const CreateEmployeeType = `
"Resposta da mutation que cria um funcionário"
type CreateEmployee {
  "Funcionário criado"
  employee: Employee
  """
  | internalCode | statusCode | message/Descrição                                           |
  | :----------- | :--------: | ----------------------------------------------------------- |
  | 600          |    500     | Erro inesperado. Veja error.internalError e avisar ao back. |
  | 610          |    403     | Token inválido                                              |
  | 611          |    401     | Cabeçalho de autorização inválido                           |
  | 700          |    404     | Usuário não encontrado                                      |
  | 620          |    403     | Este usuário não possui permissão para esta ação            |
  | 630          |    400     | Erro na validação. Veja error.message                       |
  """
  error: MyError
}
`;

const createEmployeeMutation = `
"Cria um funcionário. APENAS PARA ('dev', 'admin')"
createEmployee(input: CreateEmployeeInput!): CreateEmployee!
`;

export const types = `
${EmployeeBankAccountType}
${EmployeeBankDataType}
${AddressType}
${EmployeeCTPSType}
${EmployeeRelativeType}
${EmployeeType}
${CreateEmployeeType}
`;

export const inputs = `
${EmployeeBankAccountInput}
${EmployeeBankDataInput}
${AddressInput}
${EmployeeCTPSInput}
${EmployeeRelativeInput}
${CreateEmployeeInput}
`;

export const Mutation = createEmployeeMutation;
