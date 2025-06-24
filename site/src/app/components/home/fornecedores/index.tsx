export default async function FornecedoresHome() {
  interface Fornecedor {
    id_fornecedor: number;
    razao_social: string;
    email: string;
    endereco: {
      logradouro: string;
      numero: string;
      bairro: string;
      cidade: string;
      estado: string;
      cep: string;
    };
  }

  let fornecedores: { data: Fornecedor[] } = { data: [] };

  try {
    const request = await fetch("http://localhost:8080/fornecedores", {
      method: "GET",
      headers: {
        "content-type": "application/json",
      },
    });
    fornecedores = await request.json();
  } catch (error) {
    console.error("Falha ao buscar fornecedores:", error);
  }

  return (
    <section className="w-full bg-gradient-to-br from-amber-200 to-amber-400 flex flex-col items-center py-10 ">
      <h2 className="text-5xl font-bold text-gray-800 mb-10">Fornecedores</h2>
      <div className="container flex flex-wrap gap-8 w-full px-4 justify-center">
        {Array.isArray(fornecedores.data) &&
          fornecedores.data.map((fornecedor) => (
            <div
              key={fornecedor.id_fornecedor}
              className="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 flex flex-col items-center p-6 border border-amber-100"
            >
              {/* Avatar com iniciais */}
              <div
                className={`w-16 h-16 rounded-full flex items-center justify-center text-white text-2xl font-bold mb-4 shadow`}
                style={{
                  backgroundColor: [
                    "#F59E42", // laranja
                    "#34D399", // verde
                    "#60A5FA", // azul
                    "#F472B6", // rosa
                    "#FBBF24", // amarelo
                    "#A78BFA", // roxo
                    "#F87171", // vermelho
                    "#38BDF8", // azul claro
                    "#4ADE80", // verde claro
                    "#FCD34D", // amarelo claro
                  ][fornecedor.id_fornecedor % 10],
                }}
              >
                {fornecedor.razao_social
                  .split(" ")
                  .map((n) => n[0])
                  .join("")
                  .slice(0, 2)
                  .toUpperCase()}
              </div>
              <h3
                className="text-xl font-semibold mb-1 text-center"
                style={{
                  color: [
                    "#F59E42",
                    "#34D399",
                    "#60A5FA",
                    "#F472B6",
                    "#FBBF24",
                    "#A78BFA",
                    "#F87171",
                    "#38BDF8",
                    "#4ADE80",
                    "#FCD34D",
                  ][fornecedor.id_fornecedor % 10],
                }}
              >
                {fornecedor.razao_social}
              </h3>
              <p className="text-gray-100 text-sm mb-2 text-center">
                {fornecedor.email}
              </p>
              <div className="text-gray-100 text-sm text-center mt-2">
                <span className="font-medium mr-1 text-gray-200">
                  Endereço:
                </span>
                <span className="text-gray-200">
                  {fornecedor.endereco.logradouro}, {fornecedor.endereco.numero}
                  <br />
                  {fornecedor.endereco.bairro} - {fornecedor.endereco.cidade}/
                  {fornecedor.endereco.estado}
                  <br />
                  CEP: {fornecedor.endereco.cep}
                </span>
              </div>
            </div>
          ))}
      </div>
    </section>
  );
}
