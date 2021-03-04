# Sistema de vendas Gerencianet
###### Por Gabriel Rodrigues

### Execução do programa:
1. #### Para executar o programa, primeiramente deve se criar essas tabelas em seu **_LocalHost_** utilizando a linguagem **MySql**:

~~~MySQL
CREATE TABLE gn_vendas.produtos (
  id_produto INT NOT NULL AUTO_INCREMENT,
  nome_produto VARCHAR(45) NOT NULL,
  valor_produto DOUBLE NOT NULL,
  PRIMARY KEY (id_produto));


CREATE TABLE gn_vendas.compras(
  link_pdf VARCHAR(100) NOT NULL,
  id_boleto INT NOT NULL,
  id_produto int(11) NOT NULL,
  PRIMARY KEY (id_boleto));

ALTER TABLE gn_vendas.compras ADD
CONSTRAINT fk_produto
FOREIGN KEY (id_produto) REFERENCES
gn_vendas.produtos(id_produto);
~~~

2. #### O segundo passo é clonar o repositório do [projeto](https://github.com/BielCR/GnVendas.git) 
3. #### Agora execute com o xampp
