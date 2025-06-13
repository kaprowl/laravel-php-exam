<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ระบบสุ่มรางวัล</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        xintegrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/lottery.css') }}">
</head>

<body>

    <div class="container py-4">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary">รางวัลลอตเตอรี่ Diversion</h2>
            <p class="text-muted" id="dataLoadStatus">ผลการออกรางวัลลอตเตอรี่ Diversion ประจำงวดนี้</p>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <a href="#" class="btn btn-light btn-sm shadow-sm" id="drawButton">ดำเนินการสุ่มรางวัล</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered text-center mb-0">
                    <thead>
                        <tr>
                            <th class="bg-light" style="width: 50%;">รางวัล</th>
                            <th class="bg-light" colspan="3">ผลรางวัล</th>
                        </tr>
                    </thead>
                    <tbody id="lotteryResultsTableBody">
                        <tr>
                            <td class="fw-bold text-start ps-3">รางวัลที่ 1</td>
                            <td colspan="3"><span id="prize1"></span></td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-start ps-3">รางวัลข้างเคียงรางวัลที่ 1</td>
                            <td><span id="prizeNeighbor1A"></span></td>
                            <td><span id="prizeNeighbor1B"></span></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-start ps-3">รางวัลที่ 2</td>
                            <td><span id="prize2A"></span></td>
                            <td><span id="prize2B"></span></td>
                            <td><span id="prize2C"></span></td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-start ps-3">รางวัลเลขท้าย 2 ตัว</td>
                            <td colspan="3"><span id="prize2"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">ตรวจสอบรางวัลลอตเตอรี่ Diversion</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="lotteryNumber" class="form-label text-muted">กรุณากรอกเลขที่ต้องการตรวจสอบ:</label>
                    <input type="text" class="form-control rounded-pill" id="lotteryNumber"
                        placeholder="ตัวอย่าง: 123" maxlength="3">
                </div>
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-primary btn-lg rounded-pill shadow"
                        id="checkButton">ตรวจสอบรางวัล</button>
                </div>
                <div id="result" class="result-box d-none text-white">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        xintegrity="sha384-eU5f4C7eX5e7N5w5F5o6S5v5P5v5P5v5P5v5P5v5P5v5P5v5P5v5P5v5P5v5P5v5P5v5P5v5P5v5P5v5P5v5P5v5P5v5P5v5P5v5P5v5P5v5"
        crossorigin="anonymous"></script>

    <script>
        let currentLotteryResults;

        const emptyLotteryResults = {
            prize1: '',
            prizeNeighbor1A: '',
            prizeNeighbor1B: '',
            prize2A: '',
            prize2B: '',
            prize2C: '',
            prize2: ''
        };

        function generateRandomNumber(digits) {
            const min = 0;
            const max = Math.pow(10, digits) - 1;
            return String(Math.floor(Math.random() * (max - min + 1)) + min).padStart(digits, '0');
        }

        function updateLotteryTable() {
            document.getElementById('prize1').textContent = currentLotteryResults.prize1;
            document.getElementById('prizeNeighbor1A').textContent = currentLotteryResults.prizeNeighbor1A;
            document.getElementById('prizeNeighbor1B').textContent = currentLotteryResults.prizeNeighbor1B;
            document.getElementById('prize2A').textContent = currentLotteryResults.prize2A;
            document.getElementById('prize2B').textContent = currentLotteryResults.prize2B;
            document.getElementById('prize2C').textContent = currentLotteryResults.prize2C;
            document.getElementById('prize2').textContent = currentLotteryResults.prize2;
        }

        function drawLottery() {
            const newPrize1 = generateRandomNumber(3);

            const prize1Int = parseInt(newPrize1);
            let newPrizeNeighbor1A_int = (prize1Int - 1 + 1000) % 1000; // 000 -> 999
            let newPrizeNeighbor1B_int = (prize1Int + 1) % 1000; // 999 -> 000

            const newPrizeNeighbor1A = String(newPrizeNeighbor1A_int).padStart(3, '0');
            const newPrizeNeighbor1B = String(newPrizeNeighbor1B_int).padStart(3, '0');

            const Prize2Numbers = new Set([newPrize1, newPrizeNeighbor1A, newPrizeNeighbor1B]);

            let newPrize2A, newPrize2B, newPrize2C;

            do {
                newPrize2A = generateRandomNumber(3);
            } while (Prize2Numbers.has(newPrize2A)); // ถ้าใน Prize2Numbers ไม่ซ้ำ ให้เพิ่มเข้า set
            Prize2Numbers.add(newPrize2A);

            do {
                newPrize2B = generateRandomNumber(3);
            } while (Prize2Numbers.has(newPrize2B));
            Prize2Numbers.add(newPrize2B);

            do {
                newPrize2C = generateRandomNumber(3);
            } while (Prize2Numbers.has(newPrize2C));
            Prize2Numbers.add(newPrize2C);

            const newPrize2_digit = generateRandomNumber(2);

            currentLotteryResults = {
                prize1: newPrize1,
                prizeNeighbor1A: newPrizeNeighbor1A,
                prizeNeighbor1B: newPrizeNeighbor1B,
                prize2A: newPrize2A,
                prize2B: newPrize2B,
                prize2C: newPrize2C,
                prize2: newPrize2_digit
            };

            localStorage.setItem('lotteryResults', JSON.stringify(currentLotteryResults));

            updateLotteryTable();

            document.getElementById('dataLoadStatus').textContent = 'ผลการออกรางวัลล่าสุด (สุ่มใหม่)';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const storedResults = localStorage.getItem('lotteryResults');
            const dataLoadStatusElement = document.getElementById('dataLoadStatus');

            if (storedResults) {
                try {
                    currentLotteryResults = JSON.parse(storedResults);
                    dataLoadStatusElement.textContent = 'ผลการออกรางวัลล่าสุด (โหลดจาก LocalStorage)';
                } catch (e) {
                    console.error("Error parsing stored lottery results:", e);
                    currentLotteryResults = emptyLotteryResults;
                    dataLoadStatusElement.textContent =
                        'ผลการออกรางวัลล่าสุด (ข้อมูลว่างเปล่า - ข้อผิดพลาดในการโหลด)';
                    localStorage.removeItem('lotteryResults');
                }
            } else {
                currentLotteryResults = emptyLotteryResults;
                dataLoadStatusElement.textContent = 'ผลการออกรางวัลล่าสุด (ไม่มีข้อมูล)';
            }

            updateLotteryTable();
        });


        document.getElementById('checkButton').addEventListener('click', function() {
            const lotteryNumber = document.getElementById('lotteryNumber').value.trim();
            const resultDiv = document.getElementById('result');
            resultDiv.classList.remove('d-none');
            resultDiv.classList.remove('bg-danger', 'text-danger');
            resultDiv.classList.add('bg-success', 'text-success');

            if (!/^\d{3}$/.test(lotteryNumber)) {
                resultDiv.innerHTML = `<p class="mb-0"><strong>กรุณากรอกเลข 3 หลักเท่านั้น!</strong></p>`;
                resultDiv.classList.remove('bg-success', 'text-success');
                resultDiv.classList.add('bg-danger', 'text-danger');
                return;
            }

            let foundPrize = false;
            let messages = [];
            const prize1Value = currentLotteryResults.prize1;
            const prizeNeighbor1AValue = currentLotteryResults.prizeNeighbor1A;
            const prizeNeighbor1BValue = currentLotteryResults.prizeNeighbor1B;
            const prize2_A_Value = currentLotteryResults.prize2A;
            const prize2_B_Value = currentLotteryResults.prize2B;
            const prize2_C_Value = currentLotteryResults.prize2C;
            const prize2_digit_Value = currentLotteryResults.prize2;

            if (lotteryNumber === prize1Value) {
                messages.push(`<strong>${lotteryNumber} ถูกรางวัลที่ 1!</strong>`);
                foundPrize = true;
            }

            if (lotteryNumber === prizeNeighbor1AValue || lotteryNumber === prizeNeighbor1BValue) {
                messages.push(`<strong>${lotteryNumber} ถูกรางวัลข้างเคียงรางวัลที่ 1!</strong>`);
                foundPrize = true;
            }

            if (lotteryNumber === prize2_A_Value || lotteryNumber === prize2_B_Value || lotteryNumber ===
                prize2_C_Value) {
                messages.push(`<strong>${lotteryNumber} ถูกรางวัลที่ 2!</strong>`);
                foundPrize = true;
            }

            const lastTwoDigitsOfInput = lotteryNumber.substring(1);
            if (lastTwoDigitsOfInput === prize2_digit_Value) {
                if (messages.length > 0) {
                    messages.push(`และถูกรางวัลเลขท้าย 2 ตัว!`);
                } else {
                    messages.push(`<strong>ถูกรางวัลเลขท้าย 2 ตัว!</strong>`);
                }
                foundPrize = true;
            }

            if (foundPrize) {
                resultDiv.innerHTML = `<p class="mb-0">${messages.join('<br>')}</p>`;
            } else {
                resultDiv.innerHTML = `<p class="mb-0"><strong>${lotteryNumber} ไม่ถูกรางวัลใดๆ</strong></p>`;
                resultDiv.classList.remove('bg-success', 'text-success');
                resultDiv.classList.add('bg-danger', 'text-danger');
            }
        });

        document.getElementById('drawButton').addEventListener('click', function(event) {
            event.preventDefault();
            drawLottery();
        });
    </script>
</body>

</html>
