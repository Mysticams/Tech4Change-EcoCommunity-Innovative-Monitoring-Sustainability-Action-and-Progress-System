<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech4Change</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to bottom right, #56ab2f, #a8e063);
        }

        form {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        h1 {
            color: #333;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        label,
        select,
        input[type="checkbox"] {
            font-size: 1rem;
            margin: 10px 0;
            display: block;
            width: 100%;
        }

        select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"],
        button {
            background: #28a745;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            padding: 10px;
            cursor: pointer;
            font-size: 1rem;
            width: 100%;
            margin-bottom: 10px;
        }

        input[type="submit"]:hover,
        button:hover {
            background: #218838;
        }

        button {
            background: #007bff;
        }

        button:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>
    <form id="moodForm">
        <h1>Track Your Mood</h1>
        <label for="mood">How are you feeling today?</label>
        <select name="mood" id="mood" required>
            <option value="">Select Mood</option>
            <option value="Happy">Happy 😊</option>
            <option value="Sad">Sad 😢</option>
            <option value="Anxious">Anxious 😟</option>
            <option value="Excited">Excited 🎉</option>
        </select>

        <label>
            <input type="checkbox" name="plant_tree" value="yes"> Help plant a tree 🌳
        </label>

        <input type="submit" value="Submit Mood">
        <button type="button" onclick="goBack()">Return</button>
    </form>

    <script>
        document.getElementById('moodForm').addEventListener('submit', function(e) {
            e.preventDefault(); // default form submission

            // checkbox value
            const mood = document.getElementById('mood').value;
            const plantTree = document.querySelector('input[name="plant_tree"]').checked;

            if (mood) {
                Swal.fire({
                    title: 'Thank You!',
                    text: `You are feeling ${mood}. ${plantTree ? 'Thank you for helping plant a tree!' : ''}`,
                    icon: 'success',
                    confirmButtonText: 'Great!'
                });
            } else {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Please select a mood before submitting.',
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                });
            }
        });

        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>
