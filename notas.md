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