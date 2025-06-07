
function calculateRent() {
    const amount = document.getElementById('amount').value;
    if (amount) {
        const rent = (amount * 0.0012).toFixed(2);
        const emi = (rent * 0.7).toFixed(2);
        document.getElementById('result').innerText =
            `Daily Rent: ₹${rent}\nDaily EMI Part: ₹${emi}\nDaily Commission Part: ₹${(rent - emi).toFixed(2)}`;
    }
}
