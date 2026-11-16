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


# PL04 - Layouts, partials e componentes

## Parte E: `{{ }}` contra `{!! !!}` (Proteção XSS)
* **Com `{{ $evento['titulo'] }}` (E1):** No código-fonte da página (`Ctrl+U`), o código aparece escapado como `&lt;script&gt;alert(&quot;XSS&quot;)&lt;/script&gt;Hackathon ISLA 24h`. O navegador interpreta o texto literalmente e não executa o JavaScript, protegendo a aplicação contra ataques XSS.
* **Com `{!! $evento['titulo'] !!}` (E2):** A sintaxe `{!! !!}` imprime o conteúdo sem qualquer filtragem/escape. Ao abrir a página inicial, o navegador executa o código JavaScript malicioso e dispara imediatamente uma janela de alerta (`alert("XSS")`). Por segurança, `{!! !!}` nunca deve ser utilizado com dados introduzidos por utilizadores.

## Desafio Autónomo: `@push`/`@stack` vs `@section`/`@yield`
* **Diferença:** `@yield` define um espaço único no layout que é preenchido ou substituído por uma `@section` numa view filha. Já `@stack` cria uma pilha acumulativa onde várias views ou componentes podem injetar conteúdo sequencialmente através de `@push`, sem apagar o que lá estava antes.
* **Quando usar:** Usa-se `@section`/`@yield` para áreas estruturais únicas da página (como o `<title>` ou o bloco principal `@yield('conteudo')`). Usa-se `@push`/`@stack` para injetar ficheiros `<script>` ou blocos `<style>` específicos de uma página ou componente diretamente no `<head>` ou no fim do `<body>`.

# PL05 - Do ficheiro para o MySQL

* **A3 (Erro das sessões):**
  * *Erro:* `SQLSTATE[42S02]: Base table or view not found: 1146 Table 'isla_eventos.sessions' doesn't exist`
  * *Explicação:* Por omissão, o Laravel usa a base de dados (`SESSION_DRIVER=database`) para guardar as sessões dos utilizadores na tabela `sessions`, que ainda não existia porque as migrations iniciais não tinham sido executadas.

* **A4 (Tabelas do Laravel):**
  * A base de dados `isla_eventos` ficou com **9 tabelas** (`migrations`, `cache`, `cache_locks`, `jobs`, `job_batches`, `failed_jobs`, `users`, `password_reset_tokens` e `sessions`), exatamente as mesmas visíveis no phpMyAdmin.

* **B2 (Estrutura da tabela `eventos`):**
  * `titulo`: `varchar(150)`
  * `data`: `date`
  * `vagas`: `smallint(5) unsigned`
  * *Porquê `unsigned`?* Porque o número de vagas de um evento nunca pode ser negativo (apenas valores inteiros maiores ou iguais a zero), duplicando também o limite máximo positivo do tipo `smallint`.

* **B3 (Status e Rollback):**
  * A migration ficou no **lote (batch) 2**.
  * Ao executar `php artisan migrate:rollback`, a tabela `eventos` desapareceu (foi eliminada) da base de dados no phpMyAdmin.
  * Foi chamado o método **`down()`** da migration (`Schema::dropIfExists('eventos')`).

* **C2 (Seeder):**
  * Os cinco eventos ficaram com os IDs sequenciais de **1 a 5** (`1, 2, 3, 4, 5`).

* **C3 (`migrate:fresh --seed`):**
  * *O que fez por ordem:* Primeiro apagou (*drop*) todas as tabelas existentes na base de dados; segundo executou todas as migrations desde o início (`up()`) para recriar as tabelas vazias; terceiro correu o `DatabaseSeeder` (e o `EventoSeeder`) para voltar a inserir os registos iniciais.
  * *Porquê nunca correr em produção:* Porque apaga permanentemente todos os dados reais da base de dados (inscrições de utilizadores, registos reais, etc.) antes de recriar as tabelas.

* **D3 (Erro `stdClass`):**
  * *Erro:* `ErrorException: Cannot use object of type stdClass as array`
  * *Motivo:* O Query Builder (`DB::table(...)->get()`) devolve uma coleção de objetos `stdClass` em vez de arrays associativos, exigindo a sintaxe `$evento->campo` em vez de `$evento['campo']`.

* **D4 (Códigos HTTP testados):**
  * `/`: `200 OK`
  * `/eventos`: `200 OK`
  * `/eventos?tipo=workshop`: `200 OK`
  * `/eventos?tipo=xpto`: `200 OK` (mostra o componente de alerta)
  * `/eventos/2`: `200 OK` (mostra o alerta de evento esgotado)
  * `/eventos/99`: `404 Not Found`
  * `/eventos/tipo/xpto`: `404 Not Found`

* **D5 (Proteção contra SQL Injection):**
  * *Eventos mostrados em `/eventos?tipo=' OR '1'='1`:* **0 eventos** (mostra o alerta "Não há eventos para mostrar").
  * *Significado do `?` no SQL (`select * from eventos where tipo = ?`):* O `?` é um **placeholder (parâmetro preparado / prepared statement)** do PDO. O valor vindo do utilizador é enviado separadamente da instrução SQL e tratado estritamente como texto literal, impedindo que caracteres como aspas (`'`) alterem a lógica da consulta e neutralizando ataques de SQL Injection.