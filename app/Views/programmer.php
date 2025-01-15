<style>
.calculator {
    width: 380px;
    margin: 20px;
    border: 2px solid #444;
    border-radius: 10px;
    padding: 20px;
    background-color: #1e1e1e;
    color: #fff;
    font-family: Arial, sans-serif;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    height: auto;
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
}

.mode button.active {
    background-color: #0078d7;
}

.mode button:hover {
    background-color: #666;
}

.buttons {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 10px;
}

.buttons button {
    padding: 12px;
    font-size: 1.2em;
    border: none;
    background-color: #333;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
}

.buttons button:hover {
    background-color: #444;
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

.dropdown-container {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.dropdown-container select {
    width: 48%;
}

.history-container {
    margin-left: 20px;
    padding: 10px;
    background-color: #2d2d2d;
    border-radius: 5px;
    max-width: 400px;
    flex-grow: 1;
    height: 100%;
    overflow-y: auto;
    margin-right: 200px;
    margin-top: 20px;
}

.history-container h3 {
    margin-bottom: 10px;
    color: #fff;
}

.history-list {
    display: flex;
    flex-direction: column;
    max-height: 400px;
    overflow-y: auto;
    color: #fff;
}

.history-item {
    background-color: #444;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 5px;
    margin: 5px 0;
    cursor: pointer;
}

.history-item:hover {
    background-color: #555;
}

.calculator-container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 20px;
}

</style>
<div class="content-body">
    <div class="container-fluid">
        <div class="calculator-container">
            <div class="calculator">
                <div class="display">
                    <input type="text" id="output" readonly>
                </div>

                <div class="mode">
                    <button id="hexMode" onclick="setMode('HEX')">HEX <span id="hexResult" class="result-text"></span></button>
                    <button id="decMode" onclick="setMode('DEC')">DEC <span id="decResult" class="result-text"></span></button>
                    <button id="octMode" onclick="setMode('OCT')">OCT <span id="octResult" class="result-text"></span></button>
                    <button id="binMode" onclick="setMode('BIN')">BIN <span id="binResult" class="result-text"></span></button>
                </div>

                <div class="dropdown-container">
                    <select id="bitwiseSelect">
                        <option value="">Bitwise</option>
                        <option value="&">AND</option>
                        <option value="|">OR</option>
                        <option value="^">XOR</option>
                        <option value="~">NOT</option>
                    </select>
                    <select id="bitShiftSelect">
                        <option value="">Select Shift</option>
                        <option value="ASL">Arithmetic Shift Left</option>
                        <option value="ASR">Arithmetic Shift Right</option>
                        <option value="LSL">Logical Shift Left</option>
                        <option value="LSR">Logical Shift Right</option>
                        <option value="ROL">Rotate Left</option>
                        <option value="ROR">Rotate Right</option>
                        <option value="RCL">Rotate Through Carry Left</option>
                        <option value="RCR">Rotate Through Carry Right</option>
                    </select>
                </div>

                <div class="buttons">
                    <!-- Buttons for digits and operations -->
                    <button onclick="insert('A')">A</button>
                    <button onclick="insert('<<')"><<</button>
                    <button onclick="insert('>>')">>></button>
                    <button onclick="clearDisplay()">CE</button>
                    <button onclick="deleteLast()">⌫</button>
                    <button onclick="insert('B')">B</button>
                    <button onclick="insert('(')">(</button>
                    <button onclick="insert(')')">)</button>
                    <button onclick="insert('%')">%</button>
                    <button onclick="insert('/')">/</button>
                    <button onclick="insert('C')">C</button>
                    <button onclick="insert('7')">7</button>
                    <button onclick="insert('8')">8</button>
                    <button onclick="insert('9')">9</button>
                    <button onclick="insert('*')">*</button>
                    <button onclick="insert('D')">D</button>
                    <button onclick="insert('4')">4</button>
                    <button onclick="insert('5')">5</button>
                    <button onclick="insert('6')">6</button>
                    <button onclick="insert('-')">-</button>
                    <button onclick="insert('E')">E</button>
                    <button onclick="insert('1')">1</button>
                    <button onclick="insert('2')">2</button>
                    <button onclick="insert('3')">3</button>
                    <button onclick="insert('+')">+</button>
                    <button onclick="insert('F')">F</button>
                    <button onclick="toggleSign()">+/-</button>
                    <button onclick="insert('0')">0</button>
                    <button onclick="insert('.')">.</button>
                    <button onclick="calculate()">=</button>
                </div>
            </div>

            <div class="history-container">
                <h3>History</h3>
                <div id="history-list" class="history-list"></ ```html
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    let history = [];
    let output = document.getElementById('output');
    let currentMode = 'DEC';

    function setMode(selectedMode) {
        currentMode = (currentMode === selectedMode) ? 'DEC' : selectedMode;
        updateModeButtons();
    }

    function updateModeButtons() {
        document.getElementById('hexMode').classList.toggle('active', currentMode === 'HEX');
        document.getElementById('decMode').classList.toggle('active', currentMode === 'DEC');
        document.getElementById('octMode').classList.toggle('active', currentMode === 'OCT');
        document.getElementById('binMode').classList.toggle('active', currentMode === 'BIN');
    }

    function insert(value) {
        output.value += value;
    }

    function clearDisplay() {
        output.value = '';
    }

    function deleteLast() {
        output.value = output.value.slice(0, -1);
    }

    function toggleSign() {
        output.value = output.value.startsWith('-') ? output.value.slice(1) : '-' + output.value;
    }

    function calculate() {
    try {
        const expression = output.value.trim(); // Trim whitespace
        if (!expression) throw 'Empty expression';

        // Evaluate the expression directly
        const result = eval(expression); // Use eval to calculate the result

        if (isNaN(result)) throw 'Invalid result';

        // Convert result to different modes
        const convertedResults = convertResults(result);
        updateDisplay(convertedResults);
        saveHistory(expression, result);
    } catch (error) {
        output.value = 'Error: ' + error;
        console.error(error);
    }
}

    function convertResults(result) {
        return {
            DEC: result,
            HEX: result.toString(16).toUpperCase(),
            OCT: result.toString(8),
            BIN: result.toString(2),
        };
    }

    function updateDisplay(results) {
        document.getElementById('hexResult').innerText = results.HEX;
        document.getElementById('decResult').innerText = results.DEC;
        document.getElementById('octResult').innerText = results.OCT;
        document.getElementById('binResult').innerText = results.BIN;
        output.value = results[currentMode];
    }

    function convertToCurrentMode(value) {
        const base = { 'HEX': 16, 'OCT': 8, 'BIN': 2, 'DEC': 10 }[currentMode];
        const parsedValue = parseInt(value, base);
        if (isNaN(parsedValue)) throw 'Invalid input';
        return parsedValue;
    }

    function performBitwise(operation) {
        try {
            const [num1, num2] = output.value.split(operation).map(convertToCurrentMode);
            let result;

            switch (operation) {
                case '&': result = num1 & num2; break;
                case '|': result = num1 | num2; break;
                case '^': result = num1 ^ num2; break;
                case '~': result = ~num1; break;
                case '<<': result = num1 << num2; break;
                case '>>': result = num1 >> num2; break;
                default: throw 'Invalid operation';
            }

            output.value = currentMode === 'HEX' ? result.toString(16).toUpperCase() :
                           currentMode === 'OCT' ? result.toString(8) :
                           currentMode === 'BIN' ? result.toString(2) : result.toString();
        } catch (e) {
            output.value = 'Error: ' + e;
            console.error(e);
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const bitwiseSelect = document.getElementById('bitwiseSelect');
        const bitShiftSelect = document.getElementById('bitShiftSelect');

        bitwiseSelect.addEventListener('change', function () {
            const operation = this.value;
            if (operation) {
                performBitwise(operation);
                this.value = ''; // Reset selection
            }
        });

        bitShiftSelect.addEventListener('change', function () {
            const operation = this.value;
            if (operation) {
                performBitwise(operation);
                this.value = ''; // Reset selection
            }
        });
    });

    function saveHistory(expression, result) {
        history.unshift({ expression, result });
        updateHistoryUI();
    }

    function updateHistoryUI() {
    const historyList = document.getElementById('history-list');
    historyList.innerHTML = ''; // Clear previous history
    history.forEach(item => {
        const historyItem = document.createElement('button');
        historyItem.textContent = `${item.expression} = ${item.result}`;
        historyItem.classList.add('history-item');
        historyItem.onclick = () => {
            output.value = item.expression; // Load expression into display
            calculate(); // Calculate the result and update the display
        };
        historyList.appendChild(historyItem);
    });
}

document.addEventListener('DOMContentLoaded', function () {
    loadHistory();

    function loadHistory() {
        fetch('<?= base_url("home/GetProgrammer") ?>', {
            method: 'GET',
        })
        .then(response => response.json())
        .then(data => {
            console.log(data); // Debug respons data
            const historyList = document.getElementById('history-list');
            if (!historyList) {
                console.error("Element with ID 'history-list' not found in the DOM.");
                return;
            }
            if (data.status === 'success') {
                historyList.innerHTML = ''; // Bersihkan daftar riwayat
                data.history.forEach(item => {
                    appendHistoryItem(item.expression, item.result);
                });
            } else {
                console.log('Failed to load history:', data.message);
            }
        })
        .catch(error => {
            console.error('Error fetching history:', error);
        });
    }

    function appendHistoryItem(expression, result) {
        const historyList = document.getElementById('history-list');
        if (!historyList) return;

        const historyItem = document.createElement('div');
        historyItem.className = 'history-item';
        historyItem.innerText = `${expression} = ${result}`;

        // Tambahkan event listener untuk klik
        historyItem.addEventListener('click', function () {
            const output = document.getElementById('output');
            if (!output) {
                console.error("Element with ID 'output' not found in the DOM.");
                return;
            }
            output.value = expression;
        });

        // Masukkan item ke dalam daftar (di bagian atas)
        historyList.insertBefore(historyItem, historyList.firstChild);
    }
});



</script>
