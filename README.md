<!DOCTYPE html>
<body>

  <h1>🎯 ระบบสุ่มรางวัลลอตเตอรี่ Diversion</h1>

  <p>
    เว็บแอปพลิเคชันสำหรับสุ่มรางวัลลอตเตอรี่และตรวจสอบหมายเลขรางวัล <br>
    พัฒนาโดยใช้ Laravel + Blade Template + Bootstrap 5 และ JavaScript
  </p>

  <h2>🧰 เทคโนโลยีที่ใช้</h2>
  <ul>
    <li>Laravel (Blade Template)</li>
    <li>Bootstrap 5</li>
    <li>HTML / CSS / JavaScript</li>
    <li>LocalStorage (สำหรับจำผลรางวัลล่าสุด)</li>
  </ul>

  <h2>📁 โครงสร้างโฟลเดอร์</h2>
  <pre><code>resources/
├── css/
│   └── app.css
├── views/
│   └── lottery.blade.php

public/
└── css/
    └── app.css  ← ต้องมีไฟล์นี้ถึงจะโหลด CSS ได้
</code></pre>

  <h2>🚀 วิธีติดตั้งและใช้งาน</h2>
  <ol>
    <li>ติดตั้ง Laravel dependencies:
      <pre><code>composer install</code></pre>
    </li>
    <li>ติดตั้ง Node packages (ถ้าใช้ Laravel Mix หรือ Vite):
      <pre><code>npm install</code></pre>
    </li>
    <li>คอมไพล์ CSS ด้วยคำสั่ง:
      <pre><code>npm run dev</code></pre>
    </li>
    <li>หรือคัดลอกไฟล์ <code>resources/css/app.css</code> ไปไว้ที่ <code>public/css/app.css</code> ด้วยตัวเอง</li>
    <li>เริ่มเซิร์ฟเวอร์ Laravel:
      <pre><code>php artisan serve</code></pre>
    </li>
    <li>เปิดเบราว์เซอร์ไปที่: <code>http://127.0.0.1:8000/lottery</code></li>
  </ol>

  <h2>🎮 วิธีใช้งาน</h2>
  <ul>
    <li>กดปุ่ม <strong>“ดำเนินการสุ่มรางวัล”</strong> เพื่อสุ่มหมายเลข</li>
    <li>กรอกเลข 3 หลักในช่อง แล้วกดปุ่ม <strong>“ตรวจสอบรางวัล”</strong></li>
    <li>ระบบจะเช็คว่าหมายเลขของคุณถูกรางวัลใดหรือไม่</li>
  </ul>

  <div class="note">
    <strong>หมายเหตุ:</strong> หากคุณพบว่า CSS ไม่ทำงาน ตรวจสอบให้แน่ใจว่าไฟล์ <code>app.css</code> อยู่ในโฟลเดอร์ <code>public/css</code> และมีการเชื่อมโยงใน Blade ไฟล์แบบนี้:<br>
    <code>&lt;link rel="stylesheet" href="{{ asset('css/app.css') }}"&gt;</code>
  </div>

  <h2>📸 ตัวอย่างหน้าจอ</h2>
  <p>
    <em>คุณสามารถแทรกรูปภาพที่นี่ เช่น:</em><br>
    <code>&lt;img src="./screenshot.png" alt="ตัวอย่างหน้าจอ"&gt;</code>
  </p>

  <h2>📜 License</h2>
  <p>MIT License</p>

</body>
</html>
