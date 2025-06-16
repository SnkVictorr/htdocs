export async function ProdutosHome() {
  interface Produto {
    id_produto: number;
    produto: string;
    descricao: string;
    preco: number;
    imagem: string;
  }

  //   Requisição para obter os produtos da api
  const produtos = await fetch("http://localhost:8080/produtos", {
    method: "GET",

    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((res) => {
      // console.log(res);
      if (!res.ok) {
        throw new Error("Erro ao buscar produtos");
      }
    })
    .finally(() => {
      return false;
    });

  return (
    <section className="w-full bg-gray-200 flex flex-col items-center justify-center gap-4 py-10">
      <h2 className="text-5xl font-bold text-gray-800 mb-6">Produtos</h2>
      <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        {produtos.map((produto, index) => (
          <div
            key={index}
            className="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300"
          >
            <img
              src={produto.imagem}
              alt="Produto 1"
              className="w-full h-48 object-cover rounded mb-4"
            />
            <h3 className="text-xl font-semibold mb-2">{produto.produto}</h3>
            <p className="text-gray-600 mb-4">{produto.descricao}</p>
            <span className="text-lg font-bold text-green-600">
              {produto.preco}
            </span>
          </div>
        ))}
      </div>
    </section>
  );
}
