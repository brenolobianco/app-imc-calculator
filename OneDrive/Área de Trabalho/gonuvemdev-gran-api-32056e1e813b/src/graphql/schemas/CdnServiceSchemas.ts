/**
 * Upload One Image
 */
const FileType = `
type File {
  filename: String
  mimetype: String
  encoding: String
}
`;

const CloudinaryUploadParamsInput = `
input CloudinaryUploadParamsInput {
  file: Upload
  "O campo options é um [object](https://cloudinary.com/documentation/image_upload_api_reference#upload_method), mas deve ser transformado em String antes do envio com JSON.stringify"
  options: String
}
`;

const UploadImageResponseType = `
type UploadImageResponse {
  file: File
  "[Resposta do upload](https://cloudinary.com/documentation/image_upload_api_reference#sample_response) ao CDN. Para converter para object utilize JSON.parse"
  response: String
}
`;

const UploadImagesType = `
"Resposta da mutation que faz upload de um array de imagens"
type UploadImages {
  "Resultados do upload do array de imagens"
  results: [UploadImageResponse!]
  """
  | internalCode | statusCode | message/Descrição                                           |
  | :----------- | :--------: | ----------------------------------------------------------- |
  | 600          |    500     | Erro inesperado. Veja error.internalError e avisar ao back. |
  | 610          |    403     | Token inválido                                              |
  | 611          |    401     | Cabeçalho de autorização inválido                           |
  | 700          |    404     | Usuário não encontrado                                      |
  | 900          |    500     | Erro do cloudinary                                          |
  """
  error: MyError
}
`;

const uploadImagesMutation = `
"Faz o upload de um array de imagens como [neste tutorial](https://blog.apollographql.com/file-uploads-with-apollo-server-2-0-5db2f3f60675)"
uploadImages(
  "Parâmetros do upload de imagens no Cloudinary"
  params: [CloudinaryUploadParamsInput!]!
): UploadImages
`;

const UploadOneImageType = `
"Resposta da mutation que faz upload de uma imagem"
type UploadOneImage {
  file: File
  "[Resposta do upload](https://cloudinary.com/documentation/image_upload_api_reference#sample_response) ao CDN. Para converter para object utilize JSON.parse"
  response: String
  """
  | internalCode | statusCode | message/Descrição                                           |
  | :----------- | :--------: | ----------------------------------------------------------- |
  | 600          |    500     | Erro inesperado. Veja error.internalError e avisar ao back. |
  | 610          |    403     | Token inválido                                              |
  | 611          |    401     | Cabeçalho de autorização inválido                           |
  | 700          |    404     | Usuário não encontrado                                      |
  | 900          |    500     | Erro do cloudinary                                          |
  """
  error: MyError
}
`;

const uploadOneImageMutation = `
"Faz o upload de uma imagem como [neste tutorial](https://blog.apollographql.com/file-uploads-with-apollo-server-2-0-5db2f3f60675)"
uploadOneImage(
  file: Upload
  "O campo options é um [object](https://cloudinary.com/documentation/image_upload_api_reference#upload_method), mas deve ser transformado em String antes do envio com JSON.stringify"
  options: String
): UploadOneImage
`;

export const types = `
${FileType}
${UploadOneImageType}
${UploadImageResponseType}
${UploadImagesType}
`;

export const inputs = `
${CloudinaryUploadParamsInput}
`;

export const Mutation = `
${uploadOneImageMutation}
${uploadImagesMutation}
`;
