<!DOCTYPE html>
<html>
<head>
    <title>Registrar Frequência</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css" rel="stylesheet">
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
            // Code to generate the document
            // Display a pop-up notification to check email
            alert("Please check your email for the document to sign.");
        }
    </script>
</body>
</html>
