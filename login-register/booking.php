<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
    <link rel="stylesheet" href="booking.css">
    <style>
        #afterSubmit {
            display: none;
        }
    </style>
</head>

<body>
    <h1>Booking Page</h1>
    <form id="bookingForm">
        <div class="dropdowns">
            <label for=" city">City:</label>
            <select name="city">
                <option value="">city</option>
                <option value="Chembur">Chembur</option>
                <!-- Add more options here -->
            </select>
            <label for="area">Area:</label>
            <select name="area">
                <option value="">area</option>
                <option value="SAKEC">SAKEC</option>
            </select>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date">
            <label for="time">Time Slots:</label>
            <select name="time">
                <option value="">time</option>
                <option value="10am - 11am">10am - 11am</option>
                <option value="11am - 12pm">11am - 12pm</option>
                <option value="12pm - 1pm">12pm - 1pm</option>
                <option value="1pm - 2pm">1pm - 2pm</option>
            </select>
            <!-- ... (rest of the form) -->
        </div>
        <input type="submit" value="Submit">
    </form>
    <div id="afterSubmit">
        <h2>Available spots in selected area:</h2>
        <img class="img" src="spots.png" alt="Image">
        <div class="buttons">
            <button>P1</button>
            <button>P2</button>
            <button>P3</button>
            <button>P4</button>
            <button>P5</button>
            <button>P6</button>
            <button>A1</button>
            <button>A2</button>
            <button>A3</button>
            <button>A4</button>
            <button>A5</button>
            <button>A6</button><br>
        </div>
        <button onclick="window.location.href = '#.html';" class="book">Book</button>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
    <script>
        document.getElementById('bookingForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting normally
            document.getElementById('afterSubmit').style.display = 'block'; // Show the image and buttons
        });
        var buttons = document.querySelectorAll('.buttons button');

        // Add a click event listener to each button
        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                // If the button is white, change it back to the original color
                if (this.style.backgroundColor === 'white') {
                    this.style.backgroundColor = ''; // Original background color
                    this.style.color = ''; // Original text color
                }
                // If the button is not white, change it to white
                else {
                    this.style.backgroundColor = 'white';
                    this.style.color = 'black';
                }
            });
        });

        document.querySelector('.book').addEventListener('click', function() {
            var doc = new jsPDF();

            // Set the heading
            doc.setFontSize(22);
            doc.text('Booking Ticket', 10, 20);

            // Generate a random ticket ID
            var ticketId = Math.floor(Math.random() * 1000000);

            // Get the selected options from the form
            var selectedCity = document.querySelector('select[name="city"]').value;
            var selectedArea = document.querySelector('select[name="area"]').value;
            var selectedDate = document.querySelector('input[name="date"]').value;
            var selectedTime = document.querySelector('select[name="time"]').value;

            // Get the buttons that were clicked
            var clickedButtons = Array.from(document.querySelectorAll('.buttons button'))
                .filter(button => button.style.backgroundColor === 'white')
                .map(button => button.textContent)
                .join(', ');

            doc.setFontSize(12);
            doc.text('Ticket ID: ' + ticketId, 10, 30);
            doc.text('Selected City: ' + selectedCity, 10, 40);
            doc.text('Selected Area: ' + selectedArea, 10, 50);
            doc.text('Selected Date: ' + selectedDate, 10, 60);
            doc.text('Selected Time: ' + selectedTime, 10, 70);
            doc.text('Selected Slot(s): ' + clickedButtons, 10, 80);

            // Calculate the total cost
            var totalCost = clickedButtons.split(', ').length * 50;

            // Add the total cost to the document
            doc.text('Total Cost: ' + totalCost + ' INR', 10, 90);


            // Get the PDF data as a data URL
            var pdfData = doc.output('datauristring');

            // Open the data URL in a new window
            window.open(pdfData);

            // Get the buttons that were clicked and disable them and change their background color to red
            Array.from(document.querySelectorAll('.buttons button'))
                .filter(button => button.style.backgroundColor === 'white')
                .forEach(button => {
                    button.disabled = true;
                    button.style.backgroundColor = 'red';
                });
        });
    </script>
</body>

</html>