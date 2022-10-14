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


- [ ] Seeds
- [ ] CRUD
- [ ] Página gestão de Marcas e Modelos
- [ ] Página gestão de Equipamentos
- [ ] Página gestão de requisições
- [ ] Página pedidos de requisições (FrontEnd)
- [ ] Integração de Envio Email.
- [ ] Triggers envio de Emails.
- [ ] Importação de equipamentos via ficheiro Excel
- [ ] Webservice [Opcional]
- [ ] Ajuste CSS
- [ ] Testes Funcionais
- [ ] Criar Documentação

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



## Exemplos:
Chamar parametros da AppConfig nos templates blade:
```php
{{ App\App_config::GetAppConfig() }}
```



