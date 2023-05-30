<!DOCTYPE html>
<html>
<head>
    <title>Registrar Frequência</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
    <style>
        body {
            background-color: #f0f4f8;
        }
    </style>
</head>
<body>
    <div class="col-sm-12 col-md-2 mt-2">
        <button class="btn btn-dark" style="background-color: #231f20; border: none; width: 120%; border-radius: 10px 10px 10px;" onclick="history.back()">
            <div style="width: 30%;">
                <img src="/assets/images/voltar-light.png" alt="" style="background-color: #231f20; max-width: 100%;">
            </div>
        </button>
    </div>
    <div class="flex justify-center items-center h-screen">
        <div class="bg-white shadow-lg rounded p-8 w-96">
            <h2 class="text-2xl font-bold mb-4">Registrar Frequência</h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="mb-4">
                    <label class="block mb-2" for="data">Data:</label>
                    <input class="border border-gray-400 rounded px-4 py-2 w-full" type="text" name="data" id="data" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-2" for="hora-chegada">Hora de Chegada:</label>
                    <input class="border border-gray-400 rounded px-4 py-2 w-full" type="text" name="hora-chegada" id="hora-chegada" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-2" for="hora-saida">Hora de Saída:</label>
                    <input class="border border-gray-400 rounded px-4 py-2 w-full" type="text" name="hora-saida" id="hora-saida" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-2" for="assinatura">Assinatura Digital:</label>
                    <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600" type="button" onclick="generateDocument()">Gerar Documento para Assinatura</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>

    <script>
        flatpickr("#data", {
            enableTime: false,
            dateFormat: "Y-m-d",
        });
        flatpickr("#hora-chegada", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });
        flatpickr("#hora-saida", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });

        function generateDocument() {
            
            var documento = new jsPDF();
            documento.text("Data: " + document.getElementById("data").value, 10, 10);
            documento.text("Hora de Chegada: " + document.getElementById("hora-chegada").value, 10, 20);
            documento.text("Hora de Saída: " + document.getElementById("hora-saida").value, 10, 30);
            documento.save("frequencia.pdf");

    
            var urlAutentique = "https://api.autentique.com.br/documentos";
            var formData = new FormData();
            formData.append("file", documento.output("blob"), "frequencia.pdf");
            formData.append("nome", "Documento de Frequência");
        

          
            var xhr = new XMLHttpRequest();
            xhr.open("POST", urlAutentique, true);
            xhr.setRequestHeader("Authorization", "Bearer seu_token_de_autenticação");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    var urlAssinatura = response.link;
                 
                    window.location.href = urlAssinatura;
                } else if (xhr.readyState === 4) {
                   
                    alert("Erro ao enviar o documento para o Autentique.");
                }
            };
            xhr.send(formData);

          
            alert("Por favor, verifique seu e-mail para o documento a ser assinado.");
        }
    </script>
</body>
</html>
