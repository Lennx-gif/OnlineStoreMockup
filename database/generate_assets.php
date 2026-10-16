<?php
declare(strict_types=1);

$storageDir = dirname(__DIR__) . '/storage/uploads';
if (!is_dir($storageDir)) {
    mkdir($storageDir, 0755, true);
}

$products = [
    // Audio
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0101.svg',
        'title' => 'Studio Wireless Headphones',
        'category' => 'AUDIO',
        'badge' => 'Hi-Res Audio · ANC',
        'bg1' => '#edf2f7', 'bg2' => '#e2e8f0', 'accent' => '#315ce8',
        'svg' => '
            <!-- Headband -->
            <path d="M260 360 C260 210, 540 210, 540 360" fill="none" stroke="#2d3748" stroke-width="26" stroke-linecap="round"/>
            <path d="M280 320 C320 220, 480 220, 520 320" fill="none" stroke="#4a5568" stroke-width="12" stroke-linecap="round"/>
            <!-- Left Ear Cup -->
            <rect x="220" y="330" width="70" height="130" rx="35" fill="#1a202c" stroke="#4a5568" stroke-width="4"/>
            <rect x="235" y="345" width="40" height="100" rx="20" fill="#2d3748"/>
            <ellipse cx="255" cy="395" rx="10" ry="25" fill="#315ce8" opacity="0.6"/>
            <!-- Right Ear Cup -->
            <rect x="510" y="330" width="70" height="130" rx="35" fill="#1a202c" stroke="#4a5568" stroke-width="4"/>
            <rect x="525" y="345" width="40" height="100" rx="20" fill="#2d3748"/>
            <ellipse cx="545" cy="395" rx="10" ry="25" fill="#315ce8" opacity="0.6"/>
            <!-- Shadow -->
            <ellipse cx="400" cy="510" rx="170" ry="20" fill="#cbd5e0" opacity="0.6"/>
        '
    ],
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0102.svg',
        'title' => 'True Wireless Earbuds',
        'category' => 'AUDIO',
        'badge' => 'Bluetooth 5.3 · ENC',
        'bg1' => '#edf2f9', 'bg2' => '#dae4f2', 'accent' => '#2b6cb0',
        'svg' => '
            <!-- Charging Case -->
            <rect x="280" y="270" width="240" height="180" rx="70" fill="#2d3748" stroke="#4a5568" stroke-width="6"/>
            <path d="M280 340 L520 340" stroke="#1a202c" stroke-width="4"/>
            <circle cx="400" cy="370" r="5" fill="#48bb78"/>
            <!-- Left Earbud -->
            <circle cx="340" cy="230" r="28" fill="#1a202c"/>
            <rect x="330" y="240" width="20" height="45" rx="10" fill="#2d3748"/>
            <circle cx="340" cy="230" r="14" fill="#315ce8"/>
            <!-- Right Earbud -->
            <circle cx="460" cy="230" r="28" fill="#1a202c"/>
            <rect x="450" y="240" width="20" height="45" rx="10" fill="#2d3748"/>
            <circle cx="460" cy="230" r="14" fill="#315ce8"/>
            <ellipse cx="400" cy="485" rx="130" ry="16" fill="#cbd5e0" opacity="0.6"/>
        '
    ],
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0103.svg',
        'title' => 'Desktop Soundbar',
        'category' => 'AUDIO',
        'badge' => 'Dual Drivers · Bass Radiator',
        'bg1' => '#f0f4f8', 'bg2' => '#d9e2ec', 'accent' => '#334e68',
        'svg' => '
            <!-- Soundbar Body -->
            <rect x="180" y="320" width="440" height="90" rx="18" fill="#1e293b" stroke="#334155" stroke-width="4"/>
            <!-- Front Grille -->
            <rect x="195" y="335" width="410" height="60" rx="10" fill="#0f172a"/>
            <!-- Speaker Cones -->
            <circle cx="250" cy="365" r="20" fill="#334155" stroke="#38bdf8" stroke-width="2"/>
            <circle cx="250" cy="365" r="8" fill="#64748b"/>
            <circle cx="330" cy="365" r="14" fill="#1e293b" stroke="#64748b" stroke-width="1.5"/>
            <circle cx="470" cy="365" r="14" fill="#1e293b" stroke="#64748b" stroke-width="1.5"/>
            <circle cx="550" cy="365" r="20" fill="#334155" stroke="#38bdf8" stroke-width="2"/>
            <circle cx="550" cy="365" r="8" fill="#64748b"/>
            <!-- Volume Dial -->
            <circle cx="400" cy="365" r="12" fill="#38bdf8" opacity="0.8"/>
            <ellipse cx="400" cy="435" rx="200" ry="14" fill="#cbd5e0" opacity="0.6"/>
        '
    ],
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0104.svg',
        'title' => 'Portable Conference Speaker',
        'category' => 'AUDIO',
        'badge' => '360° Omnidirectional',
        'bg1' => '#edf2f7', 'bg2' => '#e2e8f0', 'accent' => '#4a5568',
        'svg' => '
            <ellipse cx="400" cy="450" rx="140" ry="20" fill="#cbd5e0" opacity="0.6"/>
            <!-- Puck Speaker -->
            <circle cx="400" cy="330" r="120" fill="#1e293b" stroke="#475569" stroke-width="6"/>
            <circle cx="400" cy="330" r="95" fill="#0f172a"/>
            <!-- Mesh pattern -->
            <circle cx="400" cy="330" r="70" fill="none" stroke="#334155" stroke-width="4" stroke-dasharray="8 6"/>
            <circle cx="400" cy="330" r="45" fill="none" stroke="#334155" stroke-width="4" stroke-dasharray="6 4"/>
            <!-- Center Button -->
            <circle cx="400" cy="330" r="24" fill="#38bdf8"/>
            <!-- Mic Indicators -->
            <circle cx="310" cy="330" r="5" fill="#10b981"/>
            <circle cx="490" cy="330" r="5" fill="#10b981"/>
            <circle cx="400" cy="240" r="5" fill="#10b981"/>
            <circle cx="400" cy="420" r="5" fill="#10b981"/>
        '
    ],

    // Accessories
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0201.svg',
        'title' => '7-in-1 Aluminum USB-C Hub',
        'category' => 'ACCESSORIES',
        'badge' => '4K HDMI · 100W PD',
        'bg1' => '#f1f5f9', 'bg2' => '#e2e8f0', 'accent' => '#64748b',
        'svg' => '
            <ellipse cx="400" cy="470" rx="160" ry="18" fill="#cbd5e0" opacity="0.6"/>
            <!-- Cable -->
            <path d="M400 230 C400 180, 480 180, 480 230 L480 260" fill="none" stroke="#475569" stroke-width="12" stroke-linecap="round"/>
            <rect x="470" y="150" width="20" height="40" rx="6" fill="#94a3b8"/>
            <!-- Aluminum Hub Body -->
            <rect x="260" y="260" width="280" height="170" rx="24" fill="#94a3b8" stroke="#cbd5e1" stroke-width="4"/>
            <rect x="275" y="275" width="250" height="140" rx="16" fill="#64748b"/>
            <!-- Ports -->
            <rect x="300" y="300" width="45" height="16" rx="4" fill="#0284c7"/>
            <rect x="360" y="300" width="45" height="16" rx="4" fill="#0284c7"/>
            <rect x="420" y="300" width="45" height="16" rx="4" fill="#0284c7"/>
            <rect x="300" y="340" width="60" height="24" rx="4" fill="#1e293b"/>
            <rect x="380" y="340" width="80" height="8" rx="2" fill="#1e293b"/>
            <rect x="380" y="354" width="50" height="6" rx="2" fill="#1e293b"/>
        '
    ],
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0202.svg',
        'title' => 'Fast Wireless Charging Stand',
        'category' => 'ACCESSORIES',
        'badge' => '15W Fast Charge · Dual Coil',
        'bg1' => '#f8fafc', 'bg2' => '#e2e8f0', 'accent' => '#3b82f6',
        'svg' => '
            <ellipse cx="400" cy="480" rx="130" ry="18" fill="#cbd5e0" opacity="0.6"/>
            <!-- Stand Base -->
            <ellipse cx="400" cy="440" rx="110" ry="35" fill="#334155" stroke="#475569" stroke-width="4"/>
            <!-- Angled Charging Plate -->
            <polygon points="330,420 470,420 450,220 350,220" fill="#1e293b" stroke="#475569" stroke-width="4"/>
            <!-- Charging Coil Graphic -->
            <circle cx="400" cy="310" r="30" fill="none" stroke="#38bdf8" stroke-width="4" stroke-dasharray="8 6"/>
            <circle cx="400" cy="310" r="10" fill="#38bdf8"/>
            <!-- LED light on base -->
            <circle cx="400" cy="455" r="4" fill="#10b981"/>
        '
    ],
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0203.svg',
        'title' => 'Braided 100W USB-C Cable',
        'category' => 'ACCESSORIES',
        'badge' => '2-Metre · 100W Fast Power',
        'bg1' => '#f1f5f9', 'bg2' => '#e2e8f0', 'accent' => '#6366f1',
        'svg' => '
            <ellipse cx="400" cy="470" rx="140" ry="18" fill="#cbd5e0" opacity="0.6"/>
            <!-- Coiled Cable -->
            <circle cx="400" cy="330" r="100" fill="none" stroke="#334155" stroke-width="18" stroke-dasharray="14 10"/>
            <circle cx="400" cy="330" r="75" fill="none" stroke="#475569" stroke-width="18" stroke-dasharray="12 8"/>
            <!-- Metal Heads -->
            <rect x="250" y="270" width="35" height="70" rx="8" fill="#94a3b8" transform="rotate(-30 250 270)"/>
            <rect x="235" y="240" width="20" height="35" rx="4" fill="#cbd5e1" transform="rotate(-30 235 240)"/>
            <rect x="490" y="320" width="35" height="70" rx="8" fill="#94a3b8" transform="rotate(25 490 320)"/>
            <rect x="525" y="360" width="20" height="35" rx="4" fill="#cbd5e1" transform="rotate(25 525 360)"/>
        '
    ],
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0204.svg',
        'title' => 'Memory Foam Wrist Rest',
        'category' => 'ACCESSORIES',
        'badge' => 'Ergonomic · Cooling Gel',
        'bg1' => '#f8fafc', 'bg2' => '#e2e8f0', 'accent' => '#475569',
        'svg' => '
            <ellipse cx="400" cy="450" rx="190" ry="20" fill="#cbd5e0" opacity="0.6"/>
            <!-- Rest Cushion -->
            <rect x="180" y="320" width="440" height="90" rx="45" fill="#1e293b" stroke="#334155" stroke-width="6"/>
            <!-- Contoured ergonomics highlight -->
            <path d="M220 365 Q400 340 580 365" stroke="#38bdf8" stroke-width="4" fill="none" opacity="0.6"/>
            <path d="M240 380 Q400 360 560 380" stroke="#475569" stroke-width="4" fill="none"/>
        '
    ],
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0205.svg',
        'title' => 'Insulated Thermal Flask (750ml)',
        'category' => 'ACCESSORIES',
        'badge' => '24h Cold · 12h Hot',
        'bg1' => '#edf2f7', 'bg2' => '#e2e8f0', 'accent' => '#0d9488',
        'svg' => '
            <ellipse cx="400" cy="490" rx="80" ry="16" fill="#cbd5e0" opacity="0.6"/>
            <!-- Bottle Body -->
            <rect x="340" y="220" width="120" height="250" rx="24" fill="#0f766e" stroke="#115e59" stroke-width="4"/>
            <!-- Cap & Loop -->
            <rect x="360" y="170" width="80" height="50" rx="10" fill="#134e4a"/>
            <circle cx="400" cy="145" r="22" fill="none" stroke="#2dd4bf" stroke-width="8"/>
            <!-- Matte highlight -->
            <path d="M360 240 L360 450" stroke="#2dd4bf" stroke-width="6" opacity="0.4" stroke-linecap="round"/>
        '
    ],

    // Peripherals
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0301.svg',
        'title' => 'Compact Mechanical Keyboard',
        'category' => 'PERIPHERALS',
        'badge' => 'Hot-Swap · RGB Backlight',
        'bg1' => '#f1f5f9', 'bg2' => '#e2e8f0', 'accent' => '#f97316',
        'svg' => '
            <ellipse cx="400" cy="460" rx="210" ry="22" fill="#cbd5e0" opacity="0.6"/>
            <!-- Keyboard Frame -->
            <rect x="180" y="240" width="440" height="190" rx="20" fill="#1e293b" stroke="#334155" stroke-width="6"/>
            <!-- Key rows -->
            <g fill="#334155" stroke="#475569" stroke-width="2">
                <!-- Esc -->
                <rect x="205" y="260" width="30" height="25" rx="4" fill="#f97316" stroke="#ea580c"/>
                <rect x="245" y="260" width="30" height="25" rx="4"/>
                <rect x="285" y="260" width="30" height="25" rx="4"/>
                <rect x="325" y="260" width="30" height="25" rx="4"/>
                <rect x="365" y="260" width="30" height="25" rx="4"/>
                <rect x="405" y="260" width="30" height="25" rx="4"/>
                <rect x="445" y="260" width="30" height="25" rx="4"/>
                <rect x="485" y="260" width="30" height="25" rx="4"/>
                <rect x="525" y="260" width="30" height="25" rx="4"/>
                <rect x="565" y="260" width="30" height="25" rx="4" fill="#3b82f6"/>
                <!-- Row 2 -->
                <rect x="205" y="295" width="40" height="25" rx="4"/>
                <rect x="255" y="295" width="30" height="25" rx="4"/>
                <rect x="295" y="295" width="30" height="25" rx="4"/>
                <rect x="335" y="295" width="30" height="25" rx="4"/>
                <rect x="375" y="295" width="30" height="25" rx="4"/>
                <rect x="415" y="295" width="30" height="25" rx="4"/>
                <rect x="455" y="295" width="30" height="25" rx="4"/>
                <rect x="495" y="295" width="30" height="25" rx="4"/>
                <rect x="535" y="295" width="60" height="25" rx="4"/>
                <!-- Row 3 & Spacebar -->
                <rect x="205" y="330" width="50" height="25" rx="4"/>
                <rect x="265" y="330" width="30" height="25" rx="4"/>
                <rect x="305" y="330" width="30" height="25" rx="4"/>
                <rect x="345" y="330" width="30" height="25" rx="4"/>
                <rect x="385" y="330" width="30" height="25" rx="4"/>
                <rect x="425" y="330" width="30" height="25" rx="4"/>
                <rect x="465" y="330" width="30" height="25" rx="4"/>
                <rect x="505" y="330" width="90" height="25" rx="4" fill="#f97316"/>
                <!-- Bottom row -->
                <rect x="205" y="365" width="45" height="28" rx="4"/>
                <rect x="260" y="365" width="45" height="28" rx="4"/>
                <rect x="315" y="365" width="180" height="28" rx="6" fill="#f8fafc" stroke="#cbd5e1"/>
                <rect x="505" y="365" width="40" height="28" rx="4"/>
                <rect x="555" y="365" width="40" height="28" rx="4"/>
            </g>
        '
    ],
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0302.svg',
        'title' => 'Ergonomic Vertical Mouse',
        'category' => 'PERIPHERALS',
        'badge' => '57° Natural Angle · Silent Click',
        'bg1' => '#f8fafc', 'bg2' => '#e2e8f0', 'accent' => '#6366f1',
        'svg' => '
            <ellipse cx="400" cy="470" rx="110" ry="18" fill="#cbd5e0" opacity="0.6"/>
            <!-- Vertical Body -->
            <path d="M330 440 C310 370 330 250 400 230 C460 210 490 320 480 440 Z" fill="#1e293b" stroke="#334155" stroke-width="6"/>
            <!-- Thumb Rest -->
            <path d="M320 420 C300 420 300 370 330 360" fill="none" stroke="#475569" stroke-width="8" stroke-linecap="round"/>
            <!-- Scroll Wheel -->
            <rect x="420" y="270" width="14" height="40" rx="7" fill="#6366f1"/>
        '
    ],
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0303.svg',
        'title' => 'High-Precision Wireless Mouse',
        'category' => 'PERIPHERALS',
        'badge' => '26K DPI · 80h Battery',
        'bg1' => '#f1f5f9', 'bg2' => '#e2e8f0', 'accent' => '#06b6d4',
        'svg' => '
            <ellipse cx="400" cy="460" rx="100" ry="18" fill="#cbd5e0" opacity="0.6"/>
            <!-- Mouse Body -->
            <path d="M330 330 C330 240 470 240 470 330 C470 430 330 430 330 330 Z" fill="#0f172a" stroke="#1e293b" stroke-width="6"/>
            <!-- Split buttons -->
            <path d="M400 240 L400 310" stroke="#334155" stroke-width="4"/>
            <!-- Scroll Wheel -->
            <rect x="393" y="260" width="14" height="32" rx="6" fill="#06b6d4"/>
            <!-- RGB Glow line -->
            <path d="M345 360 C370 390 430 390 455 360" fill="none" stroke="#06b6d4" stroke-width="3" opacity="0.7"/>
        '
    ],
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0304.svg',
        'title' => '4K Ultra-HD Webcam',
        'category' => 'PERIPHERALS',
        'badge' => 'Autofocus · Stereo Mic',
        'bg1' => '#f8fafc', 'bg2' => '#e2e8f0', 'accent' => '#3b82f6',
        'svg' => '
            <ellipse cx="400" cy="470" rx="120" ry="16" fill="#cbd5e0" opacity="0.6"/>
            <!-- Stand Mount -->
            <rect x="385" y="360" width="30" height="90" rx="6" fill="#334155"/>
            <rect x="340" y="440" width="120" height="20" rx="8" fill="#1e293b"/>
            <!-- Camera Cylinder -->
            <rect x="250" y="250" width="300" height="110" rx="55" fill="#1e293b" stroke="#334155" stroke-width="6"/>
            <!-- Lens Rings -->
            <circle cx="400" cy="305" r="42" fill="#0f172a" stroke="#475569" stroke-width="4"/>
            <circle cx="400" cy="305" r="30" fill="#1e293b" stroke="#38bdf8" stroke-width="3"/>
            <circle cx="400" cy="305" r="14" fill="#0284c7"/>
            <circle cx="395" cy="300" r="4" fill="#fff" opacity="0.8"/>
            <!-- Microphones -->
            <circle cx="290" cy="305" r="4" fill="#64748b"/>
            <circle cx="510" cy="305" r="4" fill="#64748b"/>
        '
    ],
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0305.svg',
        'title' => 'Cardioid Studio USB Microphone',
        'category' => 'PERIPHERALS',
        'badge' => 'Condenser · Tap-To-Mute',
        'bg1' => '#edf2f7', 'bg2' => '#e2e8f0', 'accent' => '#e11d48',
        'svg' => '
            <ellipse cx="400" cy="480" rx="110" ry="16" fill="#cbd5e0" opacity="0.6"/>
            <!-- Round Base & Stem -->
            <ellipse cx="400" cy="450" rx="85" ry="20" fill="#334155"/>
            <rect x="390" y="340" width="20" height="110" rx="4" fill="#475569"/>
            <!-- Shock Mount Ring -->
            <circle cx="400" cy="270" r="85" fill="none" stroke="#64748b" stroke-width="6"/>
            <!-- Mic Body -->
            <rect x="365" y="180" width="70" height="170" rx="35" fill="#1e293b" stroke="#334155" stroke-width="4"/>
            <!-- Mesh Grille -->
            <rect x="372" y="190" width="56" height="75" rx="28" fill="#e11d48" opacity="0.8"/>
            <!-- Gain Knob -->
            <circle cx="400" cy="305" r="8" fill="#94a3b8"/>
        '
    ],

    // Desk Setup
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0401.svg',
        'title' => 'Adjustable Aluminum Laptop Stand',
        'category' => 'DESK SETUP',
        'badge' => 'Ventilated · Heavy-Duty',
        'bg1' => '#f8fafc', 'bg2' => '#e2e8f0', 'accent' => '#64748b',
        'svg' => '
            <ellipse cx="400" cy="470" rx="160" ry="18" fill="#cbd5e0" opacity="0.6"/>
            <!-- Bottom Base -->
            <polygon points="260,440 540,440 510,410 290,410" fill="#94a3b8" stroke="#64748b" stroke-width="4"/>
            <!-- Dual Hinged Arms -->
            <line x1="310" y1="410" x2="330" y2="280" stroke="#64748b" stroke-width="14" stroke-linecap="round"/>
            <line x1="490" y1="410" x2="470" y2="280" stroke="#64748b" stroke-width="14" stroke-linecap="round"/>
            <!-- Top Plate -->
            <polygon points="250,300 550,300 520,240 280,240" fill="#cbd5e1" stroke="#94a3b8" stroke-width="4"/>
            <!-- Front Hooks -->
            <rect x="290" y="295" width="20" height="20" rx="4" fill="#475569"/>
            <rect x="490" y="295" width="20" height="20" rx="4" fill="#475569"/>
        '
    ],
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0402.svg',
        'title' => 'Minimalist Gas Spring Monitor Arm',
        'category' => 'DESK SETUP',
        'badge' => 'Full-Motion · VESA 75/100',
        'bg1' => '#f1f5f9', 'bg2' => '#e2e8f0', 'accent' => '#0284c7',
        'svg' => '
            <ellipse cx="400" cy="480" rx="130" ry="16" fill="#cbd5e0" opacity="0.6"/>
            <!-- Desk Clamp -->
            <rect x="360" y="420" width="80" height="40" rx="6" fill="#1e293b"/>
            <!-- Lower Arm -->
            <line x1="400" y1="420" x2="350" y2="300" stroke="#334155" stroke-width="18" stroke-linecap="round"/>
            <!-- Gas Spring Upper Arm -->
            <line x1="350" y1="300" x2="460" y2="220" stroke="#475569" stroke-width="18" stroke-linecap="round"/>
            <!-- VESA Plate -->
            <rect x="460" y="180" width="70" height="70" rx="10" fill="#0284c7" stroke="#38bdf8" stroke-width="4"/>
            <circle cx="495" cy="215" r="6" fill="#fff"/>
        '
    ],
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0403.svg',
        'title' => 'Dimmable LED Desk Lamp',
        'category' => 'DESK SETUP',
        'badge' => 'Eye-Care · 5 Color Temps',
        'bg1' => '#fefce8', 'bg2' => '#fef08a', 'accent' => '#ca8a04',
        'svg' => '
            <ellipse cx="400" cy="480" rx="130" ry="16" fill="#cbd5e0" opacity="0.6"/>
            <!-- Base -->
            <ellipse cx="360" cy="450" rx="70" ry="20" fill="#334155"/>
            <!-- Stem -->
            <line x1="360" y1="450" x2="360" y2="240" stroke="#475569" stroke-width="14" stroke-linecap="round"/>
            <!-- Horizontal Arm & Light Bar -->
            <line x1="350" y1="240" x2="520" y2="240" stroke="#334155" stroke-width="14" stroke-linecap="round"/>
            <rect x="400" y="247" width="110" height="8" rx="4" fill="#fef08a"/>
            <!-- Light beam -->
            <polygon points="400,255 510,255 560,430 350,430" fill="#fef9c3" opacity="0.35"/>
        '
    ],
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0404.svg',
        'title' => 'Under-Desk Cable Tray',
        'category' => 'DESK SETUP',
        'badge' => 'No-Drill Clamp · Steel Mesh',
        'bg1' => '#f8fafc', 'bg2' => '#e2e8f0', 'accent' => '#475569',
        'svg' => '
            <ellipse cx="400" cy="460" rx="180" ry="20" fill="#cbd5e0" opacity="0.6"/>
            <!-- Clamps -->
            <rect x="250" y="240" width="24" height="70" rx="6" fill="#1e293b"/>
            <rect x="526" y="240" width="24" height="70" rx="6" fill="#1e293b"/>
            <!-- Wire Basket -->
            <path d="M250 310 L250 410 C250 430 550 430 550 410 L550 310" fill="none" stroke="#334155" stroke-width="10"/>
            <!-- Grille wires -->
            <line x1="300" y1="310" x2="300" y2="420" stroke="#475569" stroke-width="6"/>
            <line x1="350" y1="310" x2="350" y2="425" stroke="#475569" stroke-width="6"/>
            <line x1="400" y1="310" x2="400" y2="425" stroke="#475569" stroke-width="6"/>
            <line x1="450" y1="310" x2="450" y2="425" stroke="#475569" stroke-width="6"/>
            <line x1="500" y1="310" x2="500" y2="420" stroke="#475569" stroke-width="6"/>
        '
    ],
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0405.svg',
        'title' => 'Dual-Sided Eco Leather Desk Pad',
        'category' => 'DESK SETUP',
        'badge' => '80x40cm · Water-Resistant',
        'bg1' => '#f1f5f9', 'bg2' => '#e2e8f0', 'accent' => '#1e293b',
        'svg' => '
            <ellipse cx="400" cy="460" rx="200" ry="22" fill="#cbd5e0" opacity="0.6"/>
            <!-- Mat Perspective -->
            <polygon points="180,410 620,410 560,260 240,260" fill="#1e293b" stroke="#334155" stroke-width="4"/>
            <polygon points="195,400 605,400 550,270 250,270" fill="#0f172a"/>
            <!-- Stitching -->
            <polygon points="200,395 600,395 545,275 255,275" fill="none" stroke="#475569" stroke-width="2" stroke-dasharray="6 4"/>
            <!-- Embossed Emblem -->
            <circle cx="560" cy="370" r="10" fill="#334155"/>
        '
    ],

    // Bags & Travel
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0501.svg',
        'title' => 'Commuter Tech Backpack (25L)',
        'category' => 'BAGS & TRAVEL',
        'badge' => 'Weatherproof · 16" Laptop Fit',
        'bg1' => '#edf2f7', 'bg2' => '#e2e8f0', 'accent' => '#2b6cb0',
        'svg' => '
            <ellipse cx="400" cy="480" rx="140" ry="18" fill="#cbd5e0" opacity="0.6"/>
            <!-- Top Handle -->
            <path d="M370 190 C370 160 430 160 430 190" fill="none" stroke="#2d3748" stroke-width="12" stroke-linecap="round"/>
            <!-- Backpack Shell -->
            <path d="M300 240 C300 180 500 180 500 240 L520 440 C520 460 280 460 280 440 Z" fill="#1a202c" stroke="#2d3748" stroke-width="6"/>
            <!-- Front Compartment -->
            <rect x="310" y="300" width="180" height="130" rx="16" fill="#2d3748"/>
            <line x1="330" y1="330" x2="470" y2="330" stroke="#4a5568" stroke-width="4"/>
            <!-- Accent clip -->
            <rect x="390" y="325" width="20" height="10" rx="2" fill="#315ce8"/>
        '
    ],
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0502.svg',
        'title' => 'Water-Resistant Laptop Sleeve',
        'category' => 'BAGS & TRAVEL',
        'badge' => 'Plush Fleece · Drop Protection',
        'bg1' => '#f8fafc', 'bg2' => '#e2e8f0', 'accent' => '#475569',
        'svg' => '
            <ellipse cx="400" cy="460" rx="170" ry="18" fill="#cbd5e0" opacity="0.6"/>
            <!-- Sleeve Body -->
            <rect x="240" y="250" width="320" height="200" rx="24" fill="#334155" stroke="#475569" stroke-width="6"/>
            <!-- Top Zipper -->
            <line x1="260" y1="270" x2="540" y2="270" stroke="#64748b" stroke-width="6" stroke-linecap="round"/>
            <circle cx="530" cy="270" r="6" fill="#94a3b8"/>
            <!-- Front Accessory Pocket -->
            <rect x="260" y="310" width="280" height="110" rx="12" fill="#1e293b"/>
        '
    ],
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0503.svg',
        'title' => 'Travel Electronics Cable Pouch',
        'category' => 'BAGS & TRAVEL',
        'badge' => 'Semi-Rigid · Dual Layer',
        'bg1' => '#f1f5f9', 'bg2' => '#e2e8f0', 'accent' => '#2563eb',
        'svg' => '
            <ellipse cx="400" cy="460" rx="140" ry="18" fill="#cbd5e0" opacity="0.6"/>
            <!-- Clamshell Organizer -->
            <rect x="270" y="250" width="260" height="190" rx="28" fill="#1e293b" stroke="#334155" stroke-width="6"/>
            <!-- Wrap-around zipper line -->
            <rect x="280" y="260" width="240" height="170" rx="20" fill="none" stroke="#2563eb" stroke-width="4" stroke-dasharray="8 6"/>
            <rect x="360" y="330" width="80" height="25" rx="6" fill="#334155"/>
        '
    ],
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0504.svg',
        'title' => 'Canvas Everyday Market Tote',
        'category' => 'BAGS & TRAVEL',
        'badge' => '100% Cotton · Heavy Duty',
        'bg1' => '#fefaf6', 'bg2' => '#f7ede2', 'accent' => '#b45309',
        'svg' => '
            <ellipse cx="400" cy="480" rx="130" ry="18" fill="#cbd5e0" opacity="0.6"/>
            <!-- Straps -->
            <path d="M340 270 C340 170 460 170 460 270" fill="none" stroke="#78350f" stroke-width="14" stroke-linecap="round"/>
            <!-- Tote Body -->
            <polygon points="310,260 490,260 460,450 340,450" fill="#fde68a" stroke="#d97706" stroke-width="6"/>
            <!-- Minimal Print Line -->
            <circle cx="400" cy="350" r="22" fill="#b45309"/>
        '
    ],

    // Groceries
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0601.svg',
        'title' => 'Artisan Medium-Roast Coffee Beans',
        'category' => 'GROCERIES',
        'badge' => 'Single Origin · Whole Bean 500g',
        'bg1' => '#fbf7f4', 'bg2' => '#eee1d5', 'accent' => '#78350f',
        'svg' => '
            <ellipse cx="400" cy="480" rx="120" ry="16" fill="#cbd5e0" opacity="0.6"/>
            <!-- Kraft Coffee Pouch -->
            <path d="M320 220 L480 220 L490 450 C490 465 310 465 310 450 Z" fill="#92400e" stroke="#78350f" stroke-width="6"/>
            <!-- Heat seal top -->
            <rect x="315" y="210" width="170" height="20" rx="4" fill="#78350f"/>
            <!-- Degassing Valve -->
            <circle cx="400" cy="270" r="8" fill="#b45309" stroke="#d97706" stroke-width="2"/>
            <!-- Badge on Pouch -->
            <rect x="340" y="320" width="120" height="90" rx="10" fill="#fef3c7"/>
            <circle cx="400" cy="350" r="14" fill="#78350f"/>
            <line x1="360" y1="380" x2="440" y2="380" stroke="#92400e" stroke-width="3"/>
            <line x1="375" y1="395" x2="425" y2="395" stroke="#92400e" stroke-width="3"/>
        '
    ],
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0602.svg',
        'title' => 'Ceremonial Matcha Green Tea',
        'category' => 'GROCERIES',
        'badge' => 'First Harvest · Japanese 50g',
        'bg1' => '#f0fdf4', 'bg2' => '#dcfce7', 'accent' => '#15803d',
        'svg' => '
            <ellipse cx="400" cy="470" rx="100" ry="16" fill="#cbd5e0" opacity="0.6"/>
            <!-- Matte Black Tin -->
            <rect x="330" y="250" width="140" height="190" rx="16" fill="#14532d" stroke="#166534" stroke-width="6"/>
            <!-- Tin Lid -->
            <rect x="320" y="230" width="160" height="35" rx="10" fill="#166534"/>
            <!-- Gold Label & Japanese character impression -->
            <rect x="350" y="300" width="100" height="110" rx="8" fill="#fef08a" stroke="#eab308" stroke-width="3"/>
            <circle cx="400" cy="340" r="16" fill="#15803d"/>
            <line x1="375" y1="380" x2="425" y2="380" stroke="#15803d" stroke-width="4" stroke-linecap="round"/>
        '
    ],
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0603.svg',
        'title' => 'Pure Raw Forest Honey (500g)',
        'category' => 'GROCERIES',
        'badge' => '100% Pure · Wildflower Apiary',
        'bg1' => '#fffbeb', 'bg2' => '#fef3c7', 'accent' => '#d97706',
        'svg' => '
            <ellipse cx="400" cy="480" rx="110" ry="16" fill="#cbd5e0" opacity="0.6"/>
            <!-- Glass Jar -->
            <rect x="330" y="240" width="140" height="210" rx="30" fill="#fef3c7" stroke="#fbbf24" stroke-width="4"/>
            <!-- Golden Honey fill -->
            <rect x="335" y="270" width="130" height="170" rx="20" fill="#d97706"/>
            <!-- Lid -->
            <rect x="345" y="210" width="110" height="35" rx="8" fill="#78350f"/>
            <!-- Honeycomb Badge -->
            <polygon points="400,320 425,335 425,365 400,380 375,365 375,335" fill="#fde68a" stroke="#b45309" stroke-width="3"/>
        '
    ],
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0604.svg',
        'title' => 'Roasted Almonds & Sea Salt (350g)',
        'category' => 'GROCERIES',
        'badge' => 'Slow-Roasted · High Protein',
        'bg1' => '#fafaf9', 'bg2' => '#f5f5f4', 'accent' => '#a16207',
        'svg' => '
            <ellipse cx="400" cy="480" rx="120" ry="16" fill="#cbd5e0" opacity="0.6"/>
            <!-- Stand-up Pouch -->
            <path d="M315 230 L485 230 L500 450 C500 465 300 465 300 450 Z" fill="#44403c" stroke="#292524" stroke-width="6"/>
            <!-- Clear Window showing almonds -->
            <ellipse cx="400" cy="350" rx="60" ry="40" fill="#a16207" stroke="#ca8a04" stroke-width="4"/>
            <!-- Almond shapes -->
            <ellipse cx="380" cy="345" rx="12" ry="18" fill="#d97706" transform="rotate(25 380 345)"/>
            <ellipse cx="415" cy="350" rx="12" ry="18" fill="#b45309" transform="rotate(-30 415 350)"/>
            <circle cx="395" cy="335" r="3" fill="#fff"/>
            <circle cx="420" cy="365" r="3" fill="#fff"/>
        '
    ],
    [
        'file' => 'a1b2c3d4e5f60123456789abcdef0605.svg',
        'title' => 'Artisanal Honey Oat Granola',
        'category' => 'GROCERIES',
        'badge' => 'Whole Grain · Cranberry & Seeds',
        'bg1' => '#fffdfa', 'bg2' => '#f7f1e6', 'accent' => '#b45309',
        'svg' => '
            <ellipse cx="400" cy="480" rx="120" ry="16" fill="#cbd5e0" opacity="0.6"/>
            <!-- Granola Pouch -->
            <path d="M320 220 L480 220 L495 450 C495 465 305 465 305 450 Z" fill="#d97706" stroke="#b45309" stroke-width="6"/>
            <!-- Top zip seal -->
            <rect x="315" y="210" width="170" height="20" rx="4" fill="#92400e"/>
            <!-- Front Window -->
            <circle cx="400" cy="350" r="45" fill="#fef3c7" stroke="#92400e" stroke-width="4"/>
            <!-- Granola clusters -->
            <circle cx="385" cy="340" r="8" fill="#b45309"/>
            <circle cx="410" cy="335" r="10" fill="#78350f"/>
            <circle cx="400" cy="360" r="9" fill="#dc2626"/>
            <circle cx="420" cy="360" r="7" fill="#65a30d"/>
            <circle cx="380" cy="365" r="8" fill="#b45309"/>
        '
    ]
];

foreach ($products as $item) {
    $svgContent = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 600" width="800" height="600">
  <defs>
    <linearGradient id="bgGrad" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0%" stop-color="{$item['bg1']}"/>
      <stop offset="100%" stop-color="{$item['bg2']}"/>
    </linearGradient>
    <filter id="softGlow" x="-20%" y="-20%" width="140%" height="140%">
      <feDropShadow dx="0" dy="12" stdDeviation="16" flood-color="{$item['accent']}" flood-opacity="0.12"/>
    </filter>
  </defs>

  <!-- Container card background -->
  <rect width="800" height="600" rx="28" fill="url(#bgGrad)"/>
  
  <!-- Subtle decorative background rings -->
  <circle cx="680" cy="120" r="110" fill="#fff" opacity="0.35"/>
  <circle cx="120" cy="500" r="130" fill="#fff" opacity="0.25"/>

  <!-- Category & Feature Badges -->
  <g transform="translate(48, 48)">
    <rect width="130" height="32" rx="16" fill="{$item['accent']}" opacity="0.12"/>
    <text x="65" y="21" fill="{$item['accent']}" font-family="system-ui, -apple-system, sans-serif" font-size="12" font-weight="800" letter-spacing="1.5" text-anchor="middle">{$item['category']}</text>
  </g>
  <g transform="translate(560, 48)">
    <rect width="192" height="32" rx="16" fill="#ffffff" opacity="0.85"/>
    <text x="96" y="20" fill="#475569" font-family="system-ui, -apple-system, sans-serif" font-size="11" font-weight="700" text-anchor="middle">{$item['badge']}</text>
  </g>

  <!-- Product Illustration -->
  <g filter="url(#softGlow)">
    {$item['svg']}
  </g>

  <!-- Product Caption Line -->
  <text x="400" y="555" fill="#334155" font-family="system-ui, -apple-system, sans-serif" font-size="18" font-weight="700" letter-spacing="-0.3" text-anchor="middle">{$item['title']}</text>
</svg>
SVG;

    $targetFile = $storageDir . '/' . $item['file'];
    file_put_contents($targetFile, trim($svgContent));
}

echo "Successfully generated " . count($products) . " product assets in storage/uploads/\n";
