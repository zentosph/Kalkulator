<style>

    .card {
        background-color: #333; /* Dark background for cards */
        border: none;
        color: white;
    }

    .card-header {
        background-color: #444; /* Slightly lighter background for the header */
    }

    .calculator-buttons .btn {
        margin-bottom: 10px;
        font-size: 1.2rem;
        background-color: #555; /* Dark background for buttons */
        color: white;
        border: 1px solid #444; /* Lighter border */
    }

    .calculator-buttons .btn:hover {
        background-color: #666; /* Hover effect for buttons */
    }

    .btn-light {
        background-color: #555;
        border: 1px solid #444;
        color: white;
    }

    .btn-light:hover {
        background-color: #666;
    }

    .btn-danger, .btn-warning, .btn-success {
        background-color: #d9534f; /* Red for danger */
        border: 1px solid #d43f3a;
        color: white;
    }

    .btn-warning {
        background-color: #f0ad4e; /* Yellow for warning */
        border: 1px solid #eea236;
        color: white;
    }

    .btn-success {
        background-color: #5bc0de; /* Blue for success */
        border: 1px solid #46b8da;
        color: white;
    }

    .btn-light:focus, .btn-danger:focus, .btn-warning:focus, .btn-success:focus {
        box-shadow: none;
    }

    #calculator-display {
        background-color: #222; /* Dark background for display */
        color: #fff; /* White text */
        height: 60px;
        font-size: 1.5rem;
        font-weight: bold;
        width: 100%;
        text-align: right;
        overflow-x: auto;
        white-space: nowrap;
        border: 1px solid #444; /* Border matching the dark theme */
    }

    .history-container {
        background-color: #444; /* Dark background for the history container */
        color: white;
        max-height: 100%;
        height: 400px;
        overflow-y: auto;
        padding: 10px;
    }

    .list-group-item[role="button"] {
        cursor: pointer;
        transition: background-color 0.2s ease;
        background-color: #555; /* Dark background for history items */
        color: white;
    }

    .list-group-item[role="button"]:hover {
        background-color: #666; /* Hover effect for history items */
    }

    .text-danger {
        color: #f44336; /* Red color for the error notification */
    }
</style>

<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <!-- History Section -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Standard Calculator</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" id="calculator-display" class="form-control text-right" placeholder="0" readonly>
                        </div>

                        <div id="notification" class="text-danger" style="display: none; font-weight: bold;">
                            Invalid calculation
                        </div>

                        <div class="calculator-buttons">
                            <div class="row">
                                <div class="col-3"><button class="btn btn-light btn-block" onclick="appendValue('%')">%</button></div>
                                <div class="col-3"><button class="btn btn-light btn-block" onclick="clearEntry()">CE</button></div>
                                <div class="col-3"><button class="btn btn-light btn-block" onclick="clearDisplay()">C</button></div>
                                <div class="col-3"><button class="btn btn-danger btn-block" onclick="backspace()">⌫</button></div>
                            </div>
                            <div class="row">
                                <div class="col-3"><button class="btn btn-light btn-block" onclick="appendValue('1/(')">1/X</button></div>
                                <div class="col-3"><button class="btn btn-light btn-block" onclick="appendValue('**2')">X²</button></div>
                                <div class="col-3"><button class="btn btn-light btn-block" onclick="appendValue('Math.sqrt(')">√X</button></div>
                                <div class="col-3"><button class="btn btn-warning btn-block" onclick="appendValue('/')">÷</button></div>
                            </div>
                            <div class="row">
                                <div class="col-3"><button class="btn btn-light btn-block" onclick="appendValue('7')">7</button></div>
                                <div class="col-3"><button class="btn btn-light btn-block" onclick="appendValue('8')">8</button></div>
                                <div class="col-3"><button class="btn btn-light btn-block" onclick="appendValue('9')">9</button></div>
                                <div class="col-3"><button class="btn btn-warning btn-block" onclick="appendValue('*')">×</button></div>
                            </div>
                            <div class="row">
                                <div class="col-3"><button class="btn btn-light btn-block" onclick="appendValue('4')">4</button></div>
                                <div class="col-3"><button class="btn btn-light btn-block" onclick="appendValue('5')">5</button></div>
                                <div class="col-3"><button class="btn btn-light btn-block" onclick="appendValue('6')">6</button></div>
                                <div class="col-3"><button class="btn btn-warning btn-block" onclick="appendValue('-')">−</button></div>
                            </div>
                            <div class="row">
                                <div class="col-3"><button class="btn btn-light btn-block" onclick="appendValue('1')">1</button></div>
                                <div class="col-3"><button class="btn btn-light btn-block" onclick="appendValue('2')">2</button></div>
                                <div class="col-3"><button class="btn btn-light btn-block" onclick="appendValue('3')">3</button></div>
                                <div class="col-3"><button class="btn btn-warning btn-block" onclick="appendValue('+')">+</button></div>
                            </div>
                            <div class="row">
                                <div class="col-3"><button class="btn btn-light btn-block" onclick="toggleSign()">+/-</button></div>
                                <div class="col-3"><button class="btn btn-light btn-block" onclick="appendValue('0')">0</button></div>
                                <div class="col-3"><button class="btn btn-light btn-block" onclick="appendValue('.')">.</button></div>
                                <div class="col-3"><button class="btn btn-success btn-block" onclick="calculateResult()">=</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Calculation History</h4>
                    </div>
                    <div class="card-body history-container">
                        <ul id="history-list" class="list-group">
                            <!-- History items will be dynamically loaded here -->
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



<script>
    function clearDisplay() {
    document.getElementById('calculator-display').value = '';
    document.getElementById('expression-display').textContent = ''; // Bersihkan ekspresi
    hideNotification();
}


    function clearEntry() {
        document.getElementById('calculator-display').value = '';
    }

function appendValue(value) {
    const display = document.getElementById('calculator-display');
    display.value += value; // Append value directly to the display
    hideNotification();
}


    function backspace() {
        let display = document.getElementById('calculator-display');
        display.value = display.value.slice(0, -1);
        hideNotification();
    }

    function toggleSign() {
        let display = document.getElementById('calculator-display');
        if (display.value.startsWith('-')) {
            display.value = display.value.substring(1);
        } else {
            display.value = '-' + display.value;
        }
    }

    function showNotification() {
        let notification = document.getElementById('notification');
        notification.style.display = 'block';
    }

    function hideNotification() {
        let notification = document.getElementById('notification');
        notification.style.display = 'none';
    }

    function calculateResult() {
    try {
        const display = document.getElementById('calculator-display');
        let expression = display.value;

        // Handle percentage by replacing % with /100
        expression = expression.replace(/%/g, '/100');

        // Check for empty or invalid expressions
        if (!expression || /[^0-9+\-*/().% ]/.test(expression)) {
            throw new Error('Invalid character in expression');
        }

        // Calculate the result
        const result = eval(expression); // Perform the calculation

        // Display only the result in the display
        display.value = result; // Display the result directly

        // Add to history (you can also add logic to save this in local storage or database)
        const newHistoryItem = { expression, result };
        addHistoryItem(newHistoryItem); // Add to history UI directly

        // Save history to the server (as before)
        fetch('<?= base_url("home/AddHistory") ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                input_expression: expression,
                result: result,
                feature: 'Standard',
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log(data.message);
            } else {
                console.error(data.message);
            }
        })
        .catch(error => console.error('Error saving history:', error));

    } catch (error) {
        showNotification(); // Show error message if calculation fails
        display.value = 'Invalid calculation'; // Display the error message in the input
    }
}

function addHistoryItem(item) {
    const historyList = document.getElementById('history-list');
    const noHistoryMessage = document.getElementById('no-history-message');

    // Hapus pesan "No history available" jika ada
    if (noHistoryMessage) {
        noHistoryMessage.remove();
    }

    const listItem = document.createElement('li');
    listItem.classList.add('list-group-item');
    listItem.setAttribute('role', 'button'); // Tambahkan role button
    listItem.style.cursor = 'pointer'; // Gaya kursor pointer untuk elemen interaktif
    listItem.textContent = `${item.expression} = ${item.result}`;
    
    // Tambahkan event listener
    listItem.addEventListener('click', () => {
        const display = document.getElementById('calculator-display');
        const expressionDisplay = document.getElementById('expression-display');

        // Set hasil di display utama
        display.value = item.result;

        // Tampilkan ekspresi kalkulasi di teks kecil
        expressionDisplay.textContent = item.expression;
    });

    historyList.prepend(listItem); // Tambahkan di atas daftar
}








    document.addEventListener('DOMContentLoaded', function () {
    loadHistory();

    function loadHistory() {
    fetch('<?= base_url("home/GetHistory") ?>', {
        method: 'GET',
    })
    .then(response => response.json())
    .then(data => {
        const historyList = document.getElementById('history-list');
        historyList.innerHTML = ''; // Bersihkan history sebelumnya

        if (data.length > 0) {
            data.forEach(item => {
                addHistoryItem(item); // Gunakan fungsi `addHistoryItem`
            });
        } else {
            const emptyMessage = document.createElement('li');
            emptyMessage.id = 'no-history-message';
            emptyMessage.classList.add('list-group-item', 'text-muted');
            emptyMessage.textContent = 'No history available';
            historyList.appendChild(emptyMessage);
        }
    })
    .catch(error => console.error('Error loading history:', error));
}



});

listItem.addEventListener('click', () => {
    console.log(`Clicked on: ${item.result}`);
    const display = document.getElementById('calculator-display');
    display.value = item.result;
});

function updateHistory() {
    const historyList = document.getElementById('history-list');
    historyList.innerHTML = ''; // Clear previous history

    if (history.length > 0) {
        history.forEach(item => {
            const listItem = document.createElement('li');
            listItem.classList.add('list-group-item');
            listItem.textContent = `${item.expression} = ${item.result}`;
            historyList.appendChild(listItem);
        });
    } else {
        const emptyMessage = document.createElement('li');
        emptyMessage.classList.add('list-group-item', 'text-muted');
        emptyMessage.textContent = 'No history available';
        historyList.appendChild(emptyMessage);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    // Initial history load (if any)
    updateHistory();
});

function appendValue(value) {
    const display = document.getElementById('calculator-display');
    const expressionDisplay = document.getElementById('expression-display');

    display.value += value; // Tambahkan nilai ke display utama
    expressionDisplay.textContent = display.value; // Tampilkan ekspresi yang sedang dibuat
    hideNotification();
}


</script>
