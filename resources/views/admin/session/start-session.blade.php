<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        #timeInButton,
#timeOutButton, button {
    display: none;
}

    </style>
</head>

<body>


    <div class="container bg-light text-dark d-flex flex-column min-vh-100 p-3">

        <div class="row">
            <div class="container p-2 text-dark col-6">
                <h1 id="typingText" class="display-1"></h1>
            </div>

            <div class="container p-2 col-6">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="max-w-lg w-100 bg-white shadow rounded px-5 py-4">
                        <h2 class="h4 font-weight-bold mb-3">Start Session</h2>
                        <form action="{{ route('session.store') }}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" id="previousAction" name="previous_action"
                                value="{{ $session->action ?? 'time_out' }}">
                            <input type="hidden" id="previousAction" name="previous_action"
                                value="{{ $session->action ?? 'time_in' }}">

                            <div class="mb-3">
                                <label for="barcode" class="form-label">Scan Student Barcode:</label>
                                <input type="password" id="barcode" name="barcode" class="form-control" autofocus
                                    oninput="checkInputLength()">
                            </div>

                            <div class="d-flex justify-content-end">
                                <button id="timeInButton" type="submit" name="action" value="time_in"
                                    class="btn btn-primary me-2">Time In</button>
                                <button id="timeOutButton" type="submit" name="action" value="time_out"
                                    class="btn btn-secondary">Time Out</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center mt-5">
                    @if (session('student'))
                        <div class="max-w-lg w-100 bg-white shadow rounded p-3 px-5">
                            <div>
                                @if (session('success'))
                                    <h2 class="text-success">
                                        {{ session('success') }}
                                    </h2>
                                @endif

                                @if (session('succes'))
                                    <h2 class="text-warning">
                                        {{ session('succes') }}
                                    </h2>
                                @endif
                                <h2 class="h4 font-weight-bold mt-4">Student Data</h2>

                                @if (session('student')->image)
                                    <div class="my-3 d-flex justify-content-center">
                                        <div class="overflow-hidden"
                                            style="width: 12rem; height: 12rem;">
                                            <img src="{{ asset('images/' . session('student')->image) }}"
                                                alt="Student Photo" class="img-fluid">
                                        </div>
                                    </div>
                                @else
                                    <div class="mt-3 d-flex justify-content-center">
                                        <div class="overflow-hidden text-center" style="width: 12rem; height: 12rem;">
                                            <p class="d-flex align-items-center justify-content-center h-100">
                                                NO IMAGE
                                            </p>
                                        </div>
                                    </div>
                                @endif

                                <div class="d-flex justify-content-around">
                                    <p>Name: {{ session('student')->name }}</p>
                                    <p>Course: {{ session('student')->course }}</p>
                                    <p>Student-ID: {{ session('student')->student_id }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="d-flex justify-content-center align-items-center">
                    @if (session('error'))
                        <div class="max-w-lg w-100 bg-white text-danger shadow rounded p-3 mt-3" id="error-message">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>



    <script>
        function checkInputLength() {
            var barcodeInput = document.getElementById("barcode");
            var timeInButton = document.getElementById("timeInButton");
            var timeOutButton = document.getElementById("timeOutButton");
            var previousAction = document.getElementById("previousAction").value;

            // Check if input length is 7
            // use this if nessesary "(barcodeInput.value.length === 7)"
            // Auto-click the appropriate button based on the previous action
            if (previousAction === 'time_in') {
                timeOutButton.click(); // Click the Time Out button
            } else if (previousAction === 'time_out') {
                timeInButton.click(); // Click the Time Out button
            } else {
                timeInButton.click(); // Click the Time In button
            }
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const text = "Cagayan State University Aparri Library";
            const colors = ["#FF8F00", "#ADD8E6"]; // White, Light Blue
            const typingText = document.getElementById('typingText');
            let index = 0;
            let forward = true;

            function type() {
                if (forward) {
                    if (index < text.length) {
                        const span = document.createElement('span');
                        span.textContent = text.charAt(index);
                        span.style.color = colors[index % colors.length]; // Cycle through colors
                        typingText.appendChild(span);
                        index++;
                        setTimeout(type, 100); // Adjust typing speed here
                    } else {
                        setTimeout(() => {
                            forward = false;
                            type();
                        }, 2000); // Delay before starting to erase
                    }
                } else {
                    if (index > 0) {
                        typingText.removeChild(typingText.lastChild);
                        index--;
                        setTimeout(type, 100); // Adjust erasing speed here
                    } else {
                        setTimeout(() => {
                            forward = true;
                            type();
                        }, 1000); // Delay before restarting the typing effect
                    }
                }
            }

            type(); // Start the typing effect
        });
    </script>

</body>

</html>
