<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Salário para Vendedores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        form {
            margin-top: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .resultado {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Calculadora de Salário para Vendedores</h2>
        <form action="" method="post">
            <label for="nome">Nome do Vendedor:</label><br>
            <input type="text" id="nome" name="nome" required><br>
            <label for="meta_semanal">Meta de Venda Semanal (em R$):</label><br>
            <input type="text" id="meta_semanal" name="meta_semanal" value="R$" required><br>
            <label for="meta_mensal">Meta de Venda Mensal (em R$):</label><br>
            <input type="text" id="meta_mensal" name="meta_mensal" value="R$" required><br><br>
            <input type="submit" value="Calcular Salário">
        </form>
    
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST["nome"];
            $meta_semanal = str_replace('R$', '', $_POST["meta_semanal"]);
            $meta_mensal = str_replace('R$', '', $_POST["meta_mensal"]);
            $salario_minimo = 1412; // Salário mínimo definido para todos os vendedores
            
            // Verificar se a meta semanal foi atingida
            if ($meta_semanal >= 20000) {
                // Calculando bônus por cumprimento de meta semanal (1% sobre o valor da meta)
                $bonus_semanal = $meta_semanal * 0.01;
                
                // Calculando bônus por excedente de meta semanal (5% sobre o excedente)
                $excedente_semanal = ($meta_semanal - 20000) * 0.05;
            } else {
                $bonus_semanal = 0;
                $excedente_semanal = 0;
            }
            
            // Verificar se a meta mensal foi atingida
            if ($meta_mensal >= 80000 && $bonus_semanal > 0) {
                // Calculando bônus por excedente de meta mensal (10% sobre o excedente)
                $excedente_mensal = ($meta_mensal - 80000) * 0.10;
            } else {
                $excedente_mensal = 0;
            }
           
            // Calculando o salário final
            $salario_final = $salario_minimo + $bonus_semanal + $excedente_semanal + $excedente_mensal;
    
            echo "<div class='resultado'>";
            echo "<h3>Resultado</h3>";
            echo "<p>Nome do Vendedor: $nome</p>";
            echo "<p>Salário Final: R$ " . number_format($salario_final, 2, ",", ".") . "</p>";
            echo "</div>";
        }
        ?>
    </div>
    
</body>
</html>

