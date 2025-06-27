import { User } from "@/interface/User";

export async function getUsers(): Promise<User[]> {
  // // faz uma requisição GET para a API para obter os usuários
  // const response = await fetch("http://localhost:3001/users");

  // // converte a resposta da API para JSON (formato de dados)
  // const data = await response.json();

  try {
    // Tenta fazer a requisição GET para a API no endereço <http://localhost:3001/users>

    const response = await fetch("<http://localhost:3001/users>", {
      method: "GET", // Método HTTP da requisição
      headers: {
        "Content-Type": "application/json", // Define o tipo de conteúdo como JSON
      },
      // body: JSON.stringify({ name: "John Doe" }), // Corpo da requisição (opcional, não usado em GET)
    });

    // Verifica se a resposta foi bem-sucedida (status 200)
    if (!response.ok || response.status !== 200) {
      throw new Error(`Erro na requisição: ${response.status}`);
    }
    // Converte a resposta da API para JSON (formato de dados)
    const data = await response.json();
    // Retorna a lista de usuários

    // retorna os dados
    return data;
  } catch (error) {
    // Captura qualquer erro que ocorra (ex.: servidor offline, JSON inválido)
    console.error("Erro ao buscar usuários:", error);
    return []; // Retorna null para indicar que houve um erro
  } finally {
    // Executa sempre, independentemente de sucesso ou erro
    console.log("Requisição GET finalizada");
  }
}
