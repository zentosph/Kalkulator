<style>
    .date-form {
        margin-top: 20px;
        background-color: #1e1e1e; /* Dark background */
        padding: 25px;
        border-radius: 15px;
        color: #fff; /* Light text color */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3); /* Soft shadow */
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .mode {
        margin-bottom: 20px;
    }

    .mode select {
        width: 100%;
        padding: 12px;
        font-size: 1.1em;
        background-color: #333;
        color: #fff;
        border-radius: 8px;
        border: 1px solid #555;
        transition: background-color 0.3s ease;
    }

    .mode select:hover {
        background-color: #444;
    }

    .input-group {
        margin-bottom: 20px;
    }

    .input-group label {
        display: block;
        font-size: 1.1em;
        font-weight: bold;
        margin-bottom: 5px;
        color: #bbb; /* Light label color */
    }

    .input-group input,
    .input-group select {
        width: 100%;
        padding: 12px;
        font-size: 1em;
        border-radius: 8px;
        border: 1px solid #444;
        background-color: #333; /* Dark input field */
        color: #fff;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .input-group input:focus,
    .input-group select:focus {
        border-color: #5b9bd5;
        box-shadow: 0 0 8px rgba(91, 155, 213, 0.6); /* Focus effect */
    }

    button {
        padding: 12px 20px;
        font-size: 1.1em;
        background-color: #444; /* Dark button color */
        color: #fff;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        width: 100%;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #555; /* Darker button color on hover */
    }

    #result {
        margin-top: 20px;
        font-size: 1.1em;
        font-weight: bold;
        color: #fff; /* Light text for results */
    }

</style>

<div class="content-body">
    <div class="container-fluid">
        <div class="calculator">
            <!-- Mode Selector for Date Calculation -->

            <!-- Date Form (Card) -->
            <div id="dateForm" class="date-form">
                <div class="mode">
                    <select id="dateOperationSelect" onchange="changeDateOperation()">
                        <option value="difference">Difference Between Dates</option>
                        <option value="add">Add Days</option>
                        <option value="subtract">Subtract Days</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="fromDate">From:</label>
                    <input type="date" id="fromDate">
                </div>

                <div class="input-group" id="toDateGroup">
                    <label for="toDate">To:</label>
                    <input type="date" id="toDate">
                </div>

                <div class="input-group" id="daysGroup">
                    <label for="daysInput">Days:</label>
                    <input type="number" id="daysInput" min="0">
                </div>

                <button onclick="calculateDate()">Calculate</button>

                <div id="result">
                    <p id="dateResult">Result: </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function changeDateOperation() {
        const operation = document.getElementById("dateOperationSelect").value;
        const toDateGroup = document.getElementById("toDateGroup");
        const daysGroup = document.getElementById("daysGroup");

        // Show the appropriate form based on the selection
        if (operation === "difference") {
            toDateGroup.style.display = "block";
            daysGroup.style.display = "none";
        } else {
            toDateGroup.style.display = "none";
            daysGroup.style.display = "block";
        }
    }

    function calculateDate() {
        const operation = document.getElementById("dateOperationSelect").value;
        const fromDate = document.getElementById("fromDate").value;
        const toDate = document.getElementById("toDate").value;
        const daysInput = document.getElementById("daysInput").value;

        let result = document.getElementById("dateResult");

        if (operation === "difference") {
            if (fromDate && toDate) {
                // Calculate the difference between two dates
                const startDate = new Date(fromDate);
                const endDate = new Date(toDate);
                const timeDiff = Math.abs(endDate - startDate);
                const diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); // Calculate the number of days

                result.innerText = `Difference: ${diffDays} days`;
            } else {
                result.innerText = "Please select both dates.";
            }
        } else if (operation === "add" || operation === "subtract") {
            if (fromDate && daysInput) {
                // Calculate the new date after adding or subtracting days
                const startDate = new Date(fromDate);
                const days = parseInt(daysInput);
                let newDate;

                if (operation === "add") {
                    newDate = new Date(startDate.setDate(startDate.getDate() + days));
                } else if (operation === "subtract") {
                    newDate = new Date(startDate.setDate(startDate.getDate() - days));
                }

                result.innerText = `New Date: ${newDate.toLocaleDateString()}`;
            } else {
                result.innerText = "Please select a date and enter the number of days.";
            }
        }
    }
</script>
