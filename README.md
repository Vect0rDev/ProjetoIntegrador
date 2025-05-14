# 📚 Agenda Educacional

Uma aplicação web simples feita em **HTML**, **CSS (Bootstrap)** e **JavaScript puro**, com o objetivo de simular uma agenda escolar onde é possível cadastrar matérias, datas e anexar arquivos (como imagens ou documentos). Todos os dados são manipulados diretamente no navegador — **não há necessidade de banco de dados**.

---

## ✅ Funcionalidades

- Inserir data da aula ou atividade.
- Inserir o nome da matéria.
- Anexar arquivos (imagens, PDFs, etc.).
- Exibir os dados em uma tabela dinâmica.
- Visualizar imagens diretamente como miniaturas.
- Visualizar ou baixar arquivos anexos.
- Editar ou excluir registros da agenda.

---

## 🧠 Como Funciona

- Ao preencher o formulário e enviar, os dados são adicionados dinamicamente à tabela.
- Os arquivos anexados são exibidos diretamente na tabela:
  - Imagens são exibidas como miniaturas.
  - Outros arquivos (PDFs, DOCs, etc.) são exibidos com link para visualização/baixa.
- A edição permite modificar os campos de uma linha.
- A exclusão remove a linha da tabela.
- **Os dados não são salvos ao recarregar a página**, pois não utilizamos banco de dados nem `localStorage`.
