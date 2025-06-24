export default async function ClientesHome() {
  interface Cliente {
    id_cliente: number;
    nome: string;
    email: string;
    whatsapp: string;
    imagem: string;
  }

  //requisição para obter os produtos através da API
  let clientes: { data: Cliente[] } = { data: [] };

  try {
    const request = await fetch("http://localhost:8080/clientes", {
      method: "GET",
      headers: {
        "content-type": "application/json",
      },
    });
    clientes = await request.json();
  } catch (error) {
    console.error("Falha ao buscar clientes:", error);
  }

  return (
    <section className="w-full bg-gray-950 flex flex-col items-center justify-center py-10">
      <h2 className="text-5xl font-bold text-gray-800 mb-6">Clientes</h2>
      <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3  gap-6">
        {Array.isArray(clientes.data) &&
          clientes.data.map((cliente: Cliente, index: number) => (
            <div key={index} className="flex flex-col items-center">
              <img
                src={`http://localhost:8000/clientes/imagens/${cliente.imagem}`}
                alt="Foto do Cliente"
                className="w-32 h-32 object-cover mb-4 rounded-full border-4 border-gray-200"
              />
              <h3 className="text-xl font-semibold text-gray-800">
                {cliente.nome}
              </h3>
              <p className="text-gray-600 mb-2">{cliente.email}</p>
              <span className="text-lg font-bold text-green-600 mt-2">
                {cliente.whatsapp}
              </span>
            </div>
          ))}
      </div>
    </section>
  );
}
