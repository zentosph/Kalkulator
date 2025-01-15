<style>
.temp-converter {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    gap: 20px;
    margin-top: 50px;
    padding: 20px;
    background-color: #121212; /* Dark background */
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    color: #fff;
}

.converter-display {
    flex: 1;
    max-width: 400px;
    padding: 20px;
    background-color: #1c1c1c; /* Dark card background */
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.converter-display h2 {
    font-size: 2em;
    font-weight: bold;
    color: #e0e0e0; /* Light text color */
    text-align: center;
    margin-bottom: 20px;
}

.temp-input {
    width: 100%;
    padding: 15px;
    font-size: 1.6em;
    text-align: right;
    border: 2px solid #444; /* Dark border */
    border-radius: 8px;
    margin-bottom: 20px;
    color: #fff;
    background-color: #333; /* Dark input field */
}

.unit-selection {
    margin-bottom: 20px;
}

.unit-selection label {
    font-size: 1.1em;
    font-weight: bold;
    color: #aaa; /* Lighter label color */
    margin-bottom: 5px;
    display: block;
}

.unit-selection select {
    width: 100%;
    padding: 12px;
    font-size: 1.1em;
    border-radius: 8px;
    border: 1px solid #444;
    color: #fff;
    background-color: #444; /* Dark select dropdown */
    transition: background-color 0.3s ease;
}

.unit-selection select:hover {
    background-color: #555; /* Slightly lighter on hover */
}

.convert-button {
    width: 100%;
    padding: 14px;
    font-size: 1.2em;
    color: #fff;
    background-color: #2c2c2c; /* Dark gray button */
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.convert-button:hover {
    background-color: #383838; /* Darker on hover */
    transform: scale(1.05);
}

.result-display {
    margin-top: 20px;
    font-size: 1.2em;
    font-weight: bold;
    color: #e0e0e0; /* Light text color */
    text-align: center;
}

.calc-buttons {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
    margin-top: 20px;
}

.calc-buttons button {
    padding: 20px;
    font-size: 1.3em;
    border: none;
    border-radius: 12px;
    background-color: #444; /* Dark button color */
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.calc-buttons button:hover {
    background-color: #555; /* Slightly lighter on hover */
    transform: scale(1.1);
}

.calc-buttons .zero {
    grid-column: span 2;
}
</style>




<div class="content-body">
    <div class="container-fluid">
        <div class="temp-converter">
            <!-- Left Side: Input and Result -->
            <div class="converter-display">
                <h2>Temperature Converter</h2>
                <input type="text" id="tempInput" class="temp-input" placeholder="Enter value" readonly>

                <div class="unit-selection">
                    <label for="fromUnit">From:</label>
                    <select id="fromUnit">
                        <option value="Celsius">Celsius</option>
                        <option value="Fahrenheit">Fahrenheit</option>
                        <option value="Kelvin">Kelvin</option>
                    </select>
                </div>

                <div class="unit-selection">
                    <label for="toUnit">To:</label>
                    <select id="toUnit">
                        <option value="Celsius">Celsius</option>
                        <option value="Fahrenheit">Fahrenheit</option>
                        <option value="Kelvin">Kelvin</option>
                    </select>
                </div>

                <button onclick="convertTemperature()" class="convert-button">Convert</button>

                <div id="result" class="result-display">
                    <p id="tempResult">Result: </p>
                </div>
            </div>

            <!-- Right Side: Buttons -->
            <div class="calc-buttons">
                <button onclick="appendNumber(1)">1</button>
                <button onclick="appendNumber(2)">2</button>
                <button onclick="appendNumber(3)">3</button>
                <button onclick="clearInput()">C</button>

                <button onclick="appendNumber(4)">4</button>
                <button onclick="appendNumber(5)">5</button>
                <button onclick="appendNumber(6)">6</button>
                <button onclick="appendDot()">.</button>

                <button onclick="appendNumber(7)">7</button>
                <button onclick="appendNumber(8)">8</button>
                <button onclick="appendNumber(9)">9</button>
                <button onclick="deleteLast()">DEL</button>

                <button onclick="appendNumber(0)" class="zero">0</button>
            </div>
        </div>
    </div>
</div>

<script>
   function appendNumber(number) {
    const input = document.getElementById("tempInput");
    input.value += number;
}

function appendDot() {
    const input = document.getElementById("tempInput");
    if (!input.value.includes(".")) {
        input.value += ".";
    }
}

function deleteLast() {
    const input = document.getElementById("tempInput");
    input.value = input.value.slice(0, -1);
}

function clearInput() {
    const input = document.getElementById("tempInput");
    input.value = "";
}

function convertTemperature() {
    const tempInput = parseFloat(document.getElementById("tempInput").value);
    const fromUnit = document.getElementById("fromUnit").value;
    const toUnit = document.getElementById("toUnit").value;
    const resultElement = document.getElementById("tempResult");

    if (isNaN(tempInput)) {
        resultElement.innerText = "Please enter a valid temperature.";
        return;
    }

    let convertedTemp;

    if (fromUnit === "Celsius") {
        if (toUnit === "Fahrenheit") {
            convertedTemp = (tempInput * 9/5) + 32;
        } else if (toUnit === "Kelvin") {
            convertedTemp = tempInput + 273.15;
        } else {
            convertedTemp = tempInput;
        }
    } else if (fromUnit === "Fahrenheit") {
        if (toUnit === "Celsius") {
            convertedTemp = (tempInput - 32) * 5/9;
        } else if (toUnit === "Kelvin") {
            convertedTemp = (tempInput - 32) * 5/9 + 273.15;
        } else {
            convertedTemp = tempInput;
        }
    } else if (fromUnit === "Kelvin") {
        if (toUnit === "Celsius") {
            convertedTemp = tempInput - 273.15;
        } else if (toUnit === "Fahrenheit") {
            convertedTemp = (tempInput - 273.15) * 9/5 + 32;
        } else {
            convertedTemp = tempInput;
        }
    }

    resultElement.innerText = `Result: ${convertedTemp.toFixed(2)} ${toUnit}`;
}
</script>
