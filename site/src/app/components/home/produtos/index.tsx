export default async function ProdutosHome() {
  interface Produto {
    id_produto: number;
    produto: string;
    descricao: string;
    imagem: string;
    preco: number;
  }

  //requisição para obter os produtos através da API
  let produtos: { data: Produto[] } = { data: [] };

  try {
    const request = await fetch("http://localhost:8080/produtos", {
      method: "GET",
      headers: {
        "content-type": "application/json",
      },
    });
    produtos = await request.json();
  } catch (error) {
    console.error("Falha ao buscar produtos:", error);
  }

  return (
    <section className="w-full bg-gray-200  flex flex-col items-center justify-center py-10">
      <h2 className="text-5xl font-bold text-gray-800 mb-6">Produtos</h2>
      <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        {/*Exemplo de produto */}
        {Array.isArray(produtos.data) &&
          produtos.data.map((produto: Produto, index: number) => (
            <div
              key={index}
              className="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300"
            >
              <img
                src={`http://localhost:8000/produtos/imagens/${produto.imagem}`}
                alt={produto.produto}
                className="w-full h-48 object-cover mb-4 rounded-t-lg"
              />
              <h3 className="text-xl font-semibold text-gray-800">
                {produto.produto}
              </h3>
              <p className="text-gray-600 mb-2 truncate">{produto.descricao}</p>
              <span className="text-lg font-bold text-green-600 mt-2">
                R${produto.preco}
              </span>
            </div>
          ))}
      </div>
    </section>
  );
}
