<style>
    .calculator-container {
    display: flex;
    justify-content: space-between;
    gap: 20px;
}
.calculator {
    width: 380px;
    margin: 20px 0;
    border: 2px solid #444;
    border-radius: 10px;
    padding: 20px;
    background-color: #1e1e1e;
    color: #fff;
    font-family: Arial, sans-serif;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    overflow: hidden;
    margin-left: 50px;
}

.display {
    margin-bottom: 15px;
}

.display input {
    width: 100%;
    height: 50px;
    border: none;
    border-radius: 5px;
    background-color: #333;
    color: #fff;
    font-size: 1.5em;
    text-align: right;
    padding: 10px;
    box-sizing: border-box;
}

.mode {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.mode button {
    flex: 1;
    margin: 0 5px;
    padding: 12px 0;
    border: none;
    background-color: #555;
    color: #fff;
    border-radius: 5px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s;
}

.mode button.active {
    background-color: #0078d7;
}

.mode button:hover {
    background-color: #666;
}

.buttons {
    display: grid;
    grid-template-columns: repeat(5, 1fr); /* Adjusted to 5 per row */
    gap: 10px;
    margin-bottom: 15px;
}

.buttons button {
    padding: 12px;
    font-size: 1.2em;
    border: none;
    background-color: #333;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
}

.buttons button:hover {
    background-color: #444;
    transform: scale(1.05);
}

.buttons button:active {
    background-color: #0078d7;
}

select {
    width: 100%;
    padding: 12px;
    background-color: #333;
    color: #fff;
    border: 1px solid #555;
    border-radius: 5px;
    font-size: 1em;
}

.memory-buttons {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.memory-buttons button {
    flex: 1;
    margin: 0 5px;
    padding: 12px 0;
    border: none;
    background-color: #555;
    color: #fff;
    border-radius: 5px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s;
}

.memory-buttons button:hover {
    background-color: #666;
}

.memory-buttons button:active {
    background-color: #0078d7;
}

/* Positioning the dropdowns side by side */
.dropdown-container {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.dropdown-container select {
    width: 48%; /* Make them fit side by side */
}

.history-section {
    width: 300px;
    margin-top: 20px;
    padding: 20px;
    margin-right: 200px;
    background-color: #2c2c2c;
    border-radius: 10px;
    color: #fff;
    flex-shrink: 0; /* Prevent shrinking */
    max-height: 400px; /* Limit the height */
    overflow-y: auto; /* Enable vertical scrolling */
}


.history-section h3 {
    margin-bottom: 15px;
    text-align: center;
}

.history-item {
    padding: 10px;
    background-color: #444;
    border-radius: 5px;
    margin-bottom: 10px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.history-item:hover {
    background-color: #555;
}

</style>

<div class="content-body">
    <div class="container-fluid">
        <div class="calculator-container">
            <div class="calculator">
                <div class="display">
                    <input type="text" id="output" readonly>
                </div>

                <!-- Memory Buttons -->
                <div class="memory-buttons">
                    <button onclick="memoryStore()">MS</button>
                    <button onclick="memoryRecall()">MR</button>
                    <button onclick="memoryPlus()">M+</button>
                    <button onclick="memoryMinus()">M-</button>
                    <button onclick="memoryClear()">MC</button>
                </div>

                <!-- Dropdowns (side by side) -->
                <div class="dropdown-container">
                    <select id="trigSelect">
                        <option value="">Trigonometry</option>
                        <option value="sin">sin</option>
                        <option value="cos">cos</option>
                        <option value="tan">tan</option>
                        <option value="sec">sec</option>
                        <option value="csc">csc</option>
                        <option value="cot">cot</option>
                        <option value="hyp">hyp</option>
                    </select>

                    <select id="otherFunctionsSelect">
                        <option value="">Other Functions</option>
                        <option value="abs">|x|</option>
                        <option value="rand">rand</option>
                        <option value="toDMS">→DMS</option>
                        <option value="toDeg">→Deg</option>
                    </select>
                </div>

                <!-- Calculator Buttons -->
                <div class="buttons">
                    <button onclick="insert('2nd')">2nd</button>
                    <button onclick="insert('Math.PI')">π</button>
                    <button onclick="insert('Math.E')">e</button>
                    <button onclick="clearDisplay()">C</button>
                    <button onclick="deleteLast()">⌫</button>

                    <button onclick="insert('x^2')">x²</button>
                    <button onclick="insert('1/x')">1/x</button>
                    <button onclick="insert('abs')">|x|</button>
                    <button onclick="insert('exp')">exp</button>
                    <button onclick="insert('%')">mod</button>

                    <button onclick="insert('2√x')">2√x</button>
                    <button onclick="insert('(')">(</button>
                    <button onclick="insert(')')">)</button>
                    <button onclick="factorial()">n!</button>
                    <button onclick="insert('/')">÷</button>

                    <button onclick="insert('xʸ')">xʸ</button>
                    <button onclick="insert('7')">7</button>
                    <button onclick="insert('8')">8</button>
                    <button onclick="insert('9')">9</button>
                    <button onclick="insert('*')">×</button>

                    <button onclick="insert('10^x')">10^x</button>
                    <button onclick="insert('4')">4</button>
                    <button onclick="insert('5')">5</button>
                    <button onclick="insert('6')">6</button>
                    <button onclick="insert('-')">−</button>

                    <button onclick="insert('log')">log</button>
                    <button onclick="insert('1')">1</button>
                    <button onclick="insert('2')">2</button>
                    <button onclick="insert('3')">3</button>
                    <button onclick="insert('+')">+</button>

                    <button onclick="insert('ln')">ln</button>
                    <button onclick="toggleSign()">+/-</button>
                    <button onclick="insert('0')">0</button>
                    <button onclick="insert('.')">.</button>
                    <button onclick="calculate()">=</button>
                </div>
                
            </div>

            <!-- History Section -->
            <div class="history-section">
                <h3>History</h3>
                <div id="historyContainer">
                    <!-- History will be loaded here dynamically -->
                </div>
            </div>
        </div>
    </div>
</div>


<script>
// Kalkulator script

let output = document.getElementById('output');
let mode = 'DEG';
let memory = 0;
let trigFunction = '';
let otherFunction = '';

// Insert value into the output display
function insert(value) {
    // Check if value is '10^x' and replace it with '10^'
    if (value === '10^x') {
        output.value += '10^'; // Append '10^' to the display
    } else if (value === 'x^2') {
        output.value += '**2'; // Use the '**' operator for exponentiation
    } else {
        output.value += value; // Append other values normally
    }
}
// Clear the display
function clearDisplay() {
    output.value = '';
}

// Delete the last character
function deleteLast() {
    output.value = output.value.slice(0, -1);
}

// Kalkulasi hasil hanya ketika tombol "=" ditekan
function calculate() {
    try {
        let expression = output.value;

        // Replace '10^' with 'Math.pow(10, ' for evaluation
        expression = expression.replace(/10\^(\d+)/g, 'Math.pow(10, $1)'); // Handle 10^number

        // Handle trigonometric functions
        if (trigFunction) {
            switch (trigFunction) {
                case 'sin': expression = 'Math.sin(' + expression + ')'; break;
                case 'cos': expression = 'Math.cos(' + expression + ')'; break;
                case 'tan': expression = 'Math.tan(' + expression + ')'; break;
                case 'sec': expression = '1/Math.cos(' + expression + ')'; break;
                case 'csc': expression = '1/Math.sin(' + expression + ')'; break;
                case 'cot': expression = '1/Math.tan(' + expression + ')'; break;
                case 'hyp': expression = 'Math.hypot(' + expression + ')'; break;
            }
        }

        // Handle other functions like abs, rand, etc.
        if (otherFunction) {
            switch (otherFunction) {
                case 'abs': expression = 'Math.abs(' + expression + ')'; break;
                case 'rand': expression = 'Math.random()'; break;
                case 'toDMS': expression = toDMS(expression); break;
                case 'toDeg': expression = toDeg(expression); break;
            }
        }

        // Evaluate the expression
        output.value = eval(expression); // 'eval' handles standard math, trig functions, etc.
        saveHistory(expression, output.value);

    } catch (e) {
        output.value = 'Error'; // Display error if the expression is invalid
    }
}

// Convert to DMS (Degrees, Minutes, Seconds)
function toDMS(value) {
    let degrees = Math.floor(value);
    let minutes = Math.floor((value - degrees) * 60);
    let seconds = ((value - degrees - minutes / 60) * 3600).toFixed(2);
    return `${degrees}° ${minutes}' ${seconds}"`;
}

// Convert from DMS to Decimal Degrees
function toDeg(value) {
    let valueArr = value.split("°");
    let degrees = parseFloat(valueArr[0]);
    let minutes = parseFloat(valueArr[1].split("'")[0]);
    let seconds = parseFloat(valueArr[1].split("'")[1].split('"')[0]);
    return degrees + minutes / 60 + seconds / 3600;
}

// Memory functions
function memoryStore() {
    memory = parseFloat(output.value);
}

function memoryRecall() {
    output.value = memory;
}

function memoryPlus() {
    memory += parseFloat(output.value);
}

function memoryMinus() {
    memory -= parseFloat(output.value);
}

function memoryClear() {
    memory = 0;
}

// Save the calculation history (with AJAX)
function saveHistory(expression, result) {
    $.ajax({
        url: '<?=base_url('home/AddHistory')?>',
        method: 'POST',
        data: {
            input_expression: expression,
            result: result,
            feature: 'Scientific'
        },
        success: function(response) {
            if (response.status === 'success') {
                console.log('History saved successfully.');
                // Tambahkan ke elemen history tanpa reload
                appendHistoryItem(expression, result);
            } else {
                console.log('Error saving history');
            }
        },
        error: function() {
            alert('Error saving history');
        }
    });
}


// Event listener for trig and other functions
document.getElementById('trigSelect').addEventListener('change', function() {
    trigFunction = this.value;
});

document.getElementById('otherFunctionsSelect').addEventListener('change', function() {
    otherFunction = this.value;
});

// Fetch history from the server (using AJAX)
// Fetch history from the server (using AJAX)
// Continue loadHistory function
// Fetch history from the server (using AJAX)
function loadHistory() {
    fetch('<?= base_url("home/GetScientific") ?>', {
        method: 'GET',
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const historyContainer = document.getElementById('historyContainer');
            historyContainer.innerHTML = ''; // Clear previous history

            data.history.forEach(item => {
                appendHistoryItem(item.expression, item.result);
            });
        } else {
            console.log('Failed to load history.');
        }
    })
    .catch(error => {
        console.error('Error fetching history:', error);
    });
}


// Call loadHistory on page load
document.addEventListener('DOMContentLoaded', loadHistory);



// Call loadHistory on page load
document.addEventListener('DOMContentLoaded', loadHistory);


function addHistoryItem(item) {
    const historyList = document.getElementById('historyContainer');
    const historyItem = document.createElement('div');
    historyItem.classList.add('history-item');
    historyItem.innerHTML = `<strong>${item.expression}</strong> = ${item.result}`;

    // Add a click event to reuse the history expression
    historyItem.addEventListener('click', () => {
        insert(item.result); // Insert the expression into the display
    });

    historyList.appendChild(historyItem);
}

function appendHistoryItem(expression, result) {
    const historyContainer = document.getElementById('historyContainer');
    const historyItem = document.createElement('div');
    historyItem.className = 'history-item';
    historyItem.innerText = `${expression} = ${result}`;

    historyItem.addEventListener('click', function() {
        output.value = result; // Load the expression into the display
    });

    // Insert the new history item at the top
    historyContainer.insertBefore(historyItem, historyContainer.firstChild);
}


document.addEventListener('DOMContentLoaded', function() {
    loadHistory();
});

// Load history on page load
window.onload = loadHistory;
</script>


