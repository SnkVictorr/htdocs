import { User } from "@/interface/User";

export async function getUsers(): Promise<User[]> {
  // faz uma requisição GET para a API para obter os usuários
  const response = await fetch("http://localhost:3001/users");

  // converte a resposta da API para JSON (formato de dados)
  const data = await response.json();

  // retorna os dados
  return data;
}
