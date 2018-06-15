<html>
    <head>
        <title>GUIA DE ESTUDO DO JAVASCRIPT</title>
    </head>
    <body>
        <form name="meuformulario">
            ENTRE COM O LADO "a":<input type="text" name="ladoa"><br>
            ENTRE COM O LADO "b":<input type="text" name="ladob"><br>
            ENTRE COM O LADO "c":<input type="text" name="ladoc"><br>
            <br>
            <input type="button" value="processar" onClick="triangulo()">
            <br><br>
            <input type="text" name="saida" size="25">
        </form>
        <script language="javascript">
        <!--/*CONDIÇÃO 5*/
            var a, b, c, resultado;
            function triangulo() {

                a = parseFloat(document.meuformulario.ladoa.value);
                b = parseFloat(document.meuformulario.ladob.value);
                c = parseFloat(document.meuformulario.ladoc.value);

                if (a < b + c && b < a + c && c < a + b) {
                    if (a == b && b == c) {
                        resultado = 'TRIANGULO EQUILÁTERO';
                    } else {
                        if (a == b || a == c || c == b) {
                            resultado = 'TRIANGULO ISÓSCELES';
                        } else {
                            resultado = 'TRIANGULO ESCALENO';
                        }
                    }
                } else {
                    resultado = 'NÃO É UM TRIANGULO.';
                }
                document.meuformulario.saida.value = resultado;
            }
        //-->
        </script>
    </body>
</html>