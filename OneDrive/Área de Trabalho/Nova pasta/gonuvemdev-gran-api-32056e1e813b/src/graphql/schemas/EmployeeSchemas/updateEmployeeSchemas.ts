const UpdateEmployeeInput = `
"Parâmetros para atualizar um funcionário. Pelo menos um dos campos opcionais deve ser enviado."
input UpdateEmployeeInput {
  "Nome. Mínimo: 1 caracter."
  name: String
  "Cargo. Mínimo: 1 caracter."
  occupation: String
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

const UpdateEmployeeType = `
"Resposta da mutation que atualiza um funcionário"
type UpdateEmployee {
  "Funcionário atualizado"
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
  | 721          |    404     | Funcionário não encontrado                                  |
  """
  error: MyError
}
`;

const updateEmployeeMutation = `
"Mutation que atualiza um funcionário. APENAS PARA ('dev', 'admin')"
updateEmployee(
  "Regex: /^[0-9a-fA-F]{24}$/"
  id: ID!,
  input: UpdateEmployeeInput!
): UpdateEmployee!
`;

export const types = UpdateEmployeeType;

export const inputs = UpdateEmployeeInput;

export const Mutation = updateEmployeeMutation;
