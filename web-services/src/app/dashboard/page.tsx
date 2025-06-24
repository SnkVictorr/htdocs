"use client";
import { User } from "@/interface/User";
import { getUsers } from "@/services/user/get";
import { useEffect, useState } from "react";

export default function Dashboard() {
  const [users, setUsers] = useState<User[]>([]);
  // Hook useEffect que será executado uma vez após o componente montar (por conta do array de dependência vazio [])
  useEffect(() => {
    async function fetchUsers() {
      const usersData = await getUsers();
      // Função assíncrona interna para buscar os dados dos usuários
      setUsers(usersData);
    }
    // Chama a função de busca assim que o componente carrega
    fetchUsers();
  }, []);
  return (
    // DIV principal com estilização tailwind
    <div className="p-6">
      <table className="w-full border">
        <thead>
          <tr className="bg-gray-200">
            <th className="p-4 border">ID</th>
            <th className="p-4 border">Email</th>
            <th className="p-4 border">Ações</th>
          </tr>
        </thead>
        <tbody>
          {users.map((user) => (
            <tr key={user.id} className="hover:bg-gray-100">
              <td className="p-4 border">{user.id}</td>
              <td className="p-4 border">{user.email}</td>
              <td className="p-4 border">
                {/* Ações podem ser adicionadas aqui */}
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}
