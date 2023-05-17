const AdminType = `
"Administrador"
type Admin {
  "Id"
  _id: ID!
  "Usuário associado ao administrador"
  user: BasicUser!
  "Funcionário associado"
  employee: Employee
  "Data de criação"
  createdAt: Date!
  "Data de atualização"
  updatedAt: Date!
}
`;

const ReadOwnProfileType = `
"Resposta do detalhe do perfil do administrador"
type ReadOwnProfile {
  admin: Admin
  error: MyError
}
`;

const readOwnProfileQuery = `
"Detalhar perfil do administrador logado. APENAS PARA ('admin')"
readOwnProfile: ReadOwnProfile!
`;

export const types = `
${AdminType}
${ReadOwnProfileType}
`;

export const Query = `
${readOwnProfileQuery}
`;
