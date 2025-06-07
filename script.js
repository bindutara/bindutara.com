function calculateRent() {
    const amount = parseFloat(document.getElementById("amount").value);
    if (isNaN(amount) || amount <= 0) {
        document.getElementById("result").textContent = "Enter a valid amount.";
        return;
    }
    const daily = (amount / 100000) * 120;
    const rent = (amount / 100000) * 100;
    const emi = (amount / 100000) * 20;
    document.getElementById("result").textContent = `Daily Pay: ₹${daily.toFixed(2)} (₹${rent.toFixed(2)} rent + ₹${emi.toFixed(2)} EMI)`;
}