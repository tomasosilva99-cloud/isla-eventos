# PL01 - Respostas e Anotações

## Parte A: Onde está o quê
1. **Em que ficheiro estão as rotas da aplicação web?**
   As rotas estão no ficheiro `routes/web.php`.

2. **Em que pasta estão as views? Como se chama a view da página de boas-vindas?**
   As views estão na pasta `resources/views/`. A view de boas-vindas chama-se `welcome.blade.php`.

3. **Em que ficheiro está o nome da base de dados? Porque é que esse ficheiro não vai para o GitHub?**
   Está no ficheiro `.env`. Não vai para o GitHub por razões de segurança, pois contém credenciais privadas, senhas e configurações específicas de cada ambiente local (estando devidamente incluído no ficheiro `.gitignore`).

---

## Parte B: Anotações de Exercícios
* **B2. Proteção com `e()`:**
  Ao aceder a `/ola/<h1>Ana` com a função `e()`, a tag HTML é convertida em texto seguro (`&lt;h1&gt;Ana`), prevenindo ataques de *Cross-Site Scripting* (XSS). Sem a função `e()`, o navegador interpreta o HTML/JavaScript diretamente (o texto surge grande como um título h1). Isso é perigoso porque permite a injeção de scripts maliciosos.

* **B5. Restrição numérica:**
  Ao aceder a `/dobro/abc` (com a restrição `->whereNumber('numero')`), obtém-se o código de estado HTTP **404 Not Found**, pois a rota deixa de corresponder a valores não numéricos.

* **B6. Provocar Erro:**
  Ao apagar o `;` em `routes/web.php`, a aplicação gera um erro com código de estado **500 Internal Server Error** (Erro de Sintaxe / *Parse Error*), indicando a linha exata onde ocorreu a falha.

  # PL02 - ISLA Eventos: Respostas e Anotações

## Parte D: Página de Detalhe e Casos Limite (D4)
* **/eventos/3:** Retorna o código de estado **200 OK**, exibindo com sucesso os detalhes do evento "Hackathon ISLA 24h".
* **/eventos/99:** Retorna o código de estado **404 Not Found**. A rota aceita o valor `99` por ser numérico, mas como não existe nenhum evento com ID 99 no array, a condição `$evento === null` é verdadeira e chama a função `abort(404)`.
* **/eventos/abc:** Retorna o código de estado **404 Not Found**. O pedido nem sequer entra na função da rota porque o encadeamento `->whereNumber('id')` restringe o parâmetro `id` a dígitos numéricos. O sistema de rotas do Laravel rejeita imediatamente a correspondência.

## Parte E: Filtrar pelo Endereço
* A leitura da query string é efetuada através da função auxiliar `request('tipo')`. 
* Em `/eventos?tipo=xpto`, a filtragem retorna um array vazio e o Blade executa o bloco `@empty` da diretiva `@forelse`, mostrando a mensagem *"Não há eventos para mostrar."*.
* Em `/eventos?tipo=<h1>x`, a sintaxe `{{ e($tipo) }}` (ou a interpolação `{{ $tipo }}` no Blade) escapa os carateres especiais de HTML, exibindo `<h1>x` como texto plano seguro e prevenindo vulnerabilidades de XSS.

## Desafio Autónomo: Ordem das Rotas
* **Questão:** Se `/eventos/{id}` não tivesse `->whereNumber('id')` e estivesse escrita **antes** de `/eventos/proximos`, o que acontecia ao abrir `/eventos/proximos`? Porquê?
* **Resposta:** Ao abrir `/eventos/proximos`, o Laravel percorreria a lista de rotas de cima para baixo. Como `/eventos/{id}` aceitaria qualquer texto sem a restrição numérica, a palavra `"proximos"` seria capturada como o parâmetro `$id`. A rota tentaria procurar no array um evento com o ID `"proximos"`, não encontraria e devolveria um **erro 404**, impedindo que a rota `/eventos/proximos` fosse alguma vez atingida.