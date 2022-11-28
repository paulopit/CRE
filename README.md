# Projeto-Final---EFA-Cesae

## Projeto GRE - Gestão de Requisições de Equipamentos

## Equipa S
 - Sérgio Fernandes
 - Paulo Pinto
 - Deivid Vieira

## Requisitos: 

- Portal com página de login e registo
- Backoffice de gestão de utilizadores, equipamentos e requisições.
- 3 tipos de utilizadores (Administrador, Técnico e Utilizador).
- Conta de Administrador com acessos totais.
- Requisições podem ser efetuadas por utilizadores ou técnicos.
- Painel de gestão de utilizadores para o administrador
- Painel de submissão e visualização de requisições com vários filtros de estado para os técnicos.
- Técnicos gerem requisições
- Técnicos podem alterar requisições ainda por aprovar.
- Utilizador pode cancelar requisições ainda por aprovar.
- Campo de referência e serial number para equipamentos é opcional.
- Mostra stock disponivel para requisição aos utilizadores.
- Requisições por aprovar reservam stock.
- Envio de notificação para o utilizador quando a requisição não é aprovada.
- Envio de notificações para requisições expiradas e para stock reduzido.
- Parametro para definir email de alertas.
- Parametro de stock baixo por percentagem.
- Importar equipamentos em massa, folha excel.
- Gestão via Webservice (Segundo Plano).
- Utilizar cores do cesae no layout.


## :rotating_light: To Do:

- []





- [x] Seeds
- [X] CRUD @Deivid
- [x] Página gestão de Marcas e Modelos
- [x] Página gestão de Equipamentos
- [x] Triggers envio de Emails.
- [x] Importação de equipamentos via ficheiro Excel
- [-] Webservice [Opcional]
- [-] Ajuste CSS
- [ ] Testes Funcionais
- [ ] Criar Documentação
- [x] Botão extender requisição [Opcional]
- [ ] Validar traduções
- [x] Adicionar forma de controlar estados de entrega e devolução dos equiapamentos (Equip_lines)
- [x] Ao editar/criar equipamento com uma referencia, atualizar as descrições dos equip com mesma ref.

@Paulo
- [ ] Nos users, listar requisicoes de cada utilizador (em Aberto / Fechadas, paginacao 5)

@Sergio
- [x] Nos equipamentos ter possibilidade de listar historico (por onde o equipamento andou).

@Deivid
- [ ] Possibilidade de Tecnico editar requisicoes por aprovar. 
- [ ] Adicionar separador para Tecnico/Admin a mostrar todas as requisicoes (não mostrar level_id 5 expiradas).

## :white_check_mark: Done:
- [x] Middlewares @Paulo
- [x] Migrations completas @Paulo
###### 
- [x] Página Login @Deivid
- [x] Página Registo @Deivid
###### 
- [x] Criar projeto. @Sergio
- [x] Integrar AdminLTE. @Sergio
- [x] Permissões Gate @Sergio
- [x] Menus AdminLTE @Sergio
- [x] Datatables AdminLTE @Sergio
- [x] Modo Tabs AdminLTE @Sergio
- [x] Sistema de traduções @Sergio
- [x] Configuração de timezone para Portugal @Sergio
- [x] Função de leitura de parametros AppConfig @Sergio
- [x] Integração de Envio Email. @Sergio
- [x] Criado middleware 'management' @Sergio
- [x] Página gestão de conta para utilizadores @Sergio
- [x] Página gestão contas para Administrador @Sergio
- [x] Página gestão de tipos de utilizador @Sergio
- [x] Página gestão de funções de utilizador @Sergio
- [x] Página gestão de parametros da APP @Sergio
- [x] CRUD UserFunction @Sergio
- [x] CRUD UserType @Sergio
- [x] CRUD AppConfig @Sergio
- [x] CRUD UserAccount @Sergio
- [x] AppConfigSeeder @Sergio
- [x] Página pedidos de requisições (FrontEnd User) @Sergio
- [x] Página gestão de requisições (BackEnd User) @Sergio




## Exemplos:
Chamar parametros da AppConfig nos templates blade:
```php
{{ App\App_config::GetAppConfig() }}
```

Incluir os alertas nas páginas:
Na linha seguinte à @section('content')

```php
@include('sweetalert::alert')
```

Adicionar traduções nas tabelas

```php
$config['language']  = [ 'url' => 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-PT.json' ];
 :config="$config"  <- adicionar na tabela
```



