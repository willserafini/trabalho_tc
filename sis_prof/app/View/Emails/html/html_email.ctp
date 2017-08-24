<table align="center" width="700" border="0" cellspacing="0" cellpadding="0" style="background-color: #fff;">
    <tr>
        <td><a href="http://www.goldshopnet.com.br"><img style="border:0px; display:block; margin-left: 20px" src="http://goldshopnet.com.br/img/logo.jpg" width="300" /></a></td>
    </tr>
    <tr>
        <td style="padding: 25px; background-color:#fefefe">
            <p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #818285;">
                <?php
                $texto = str_replace("#link#", $this->Html->link('aqui', 'http://www.goldshopnet.com.br/produto/produto_id:' . $produtoId), $texto);
                echo $texto;
                ?>
            </p>

            <div style="width: 650px; height:2px; background:#818285; font-size:0; margin-top:50px"></div>

            <p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #818285; font-weight: bold">
                <a href="http://goldshopnet.com.br" style="color: #818285; text-decoration:none;">GoldShopNet.com.br</a> <br />
                E-mail: <a href="mailto:vendas@goldshopnet.com.br" style="color: #818285; text-decoration:none;">vendas@goldshopnet.com.br</a><br />
            </p>
        </td>
    </tr>
</table>
