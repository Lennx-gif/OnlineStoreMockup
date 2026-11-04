USE online_store;

INSERT INTO products (name, description, price, stock, image, category) VALUES
-- Audio
('Studio Wireless Headphones', 'Premium over-ear headphones with hybrid active noise cancellation, 40-hour battery life, plush memory foam earcups, and high-fidelity sound.', 12500.00, 25, 'a1b2c3d4e5f60123456789abcdef0101.svg', 'Audio'),
('True Wireless Earbuds', 'Compact Bluetooth 5.3 earbuds featuring quad-mic environmental noise cancellation, IPX5 water resistance, and wireless fast-charging case.', 4800.00, 35, 'a1b2c3d4e5f60123456789abcdef0102.svg', 'Audio'),
('Desktop Stereo Soundbar', 'Sleek under-monitor soundbar with tuned dual drivers, deep bass passive radiator, and multi-mode Bluetooth / AUX / USB connectivity.', 6200.00, 18, 'a1b2c3d4e5f60123456789abcdef0103.svg', 'Audio'),
('Portable Conference Speaker', 'Professional 360-degree omnidirectional conference speaker with acoustic echo cancellation and instant hardware mute button.', 7500.00, 14, 'a1b2c3d4e5f60123456789abcdef0104.svg', 'Audio'),

-- Accessories
('7-in-1 Aluminum USB-C Hub', 'Multiport expander adapter featuring 4K@60Hz HDMI, 100W Power Delivery pass-through, UHS-I SD/TF card reader, and 3 high-speed USB 3.0 ports.', 3450.00, 40, 'a1b2c3d4e5f60123456789abcdef0201.svg', 'Accessories'),
('Fast Wireless Charging Stand', '15W Qi-certified fast charging stand with dual-coil design supporting phone placement in portrait or landscape orientations with LED status.', 2600.00, 30, 'a1b2c3d4e5f60123456789abcdef0202.svg', 'Accessories'),
('Braided 100W USB-C Cable (2m)', 'Ultra-durable double-braided nylon charging cable engineered with an E-marker smart chip supporting 100W PD and 480Mbps data transfer.', 950.00, 65, 'a1b2c3d4e5f60123456789abcdef0203.svg', 'Accessories'),
('Memory Foam Wrist Rest', 'Contoured ergonomic wrist support cushion crafted with cooling memory foam and an anti-slip silicone base to relieve repetitive strain.', 1400.00, 28, 'a1b2c3d4e5f60123456789abcdef0204.svg', 'Accessories'),
('Insulated Thermal Flask (750ml)', 'Double-wall vacuum insulated food-grade stainless steel bottle keeping beverages iced cold for 24 hours or steaming hot for 12 hours.', 1850.00, 45, 'a1b2c3d4e5f60123456789abcdef0205.svg', 'Accessories'),

-- Peripherals
('Compact Mechanical Keyboard', '75% layout mechanical keyboard with hot-swappable tactile switches, multi-layer acoustic dampening foam, and customizable RGB backlighting.', 7800.00, 20, 'a1b2c3d4e5f60123456789abcdef0301.svg', 'Peripherals'),
('Ergonomic Vertical Mouse', 'Natural handshake posture vertical mouse with 57-degree biomechanical tilt, whisper-quiet switches, and precision multi-gear optical DPI.', 2950.00, 32, 'a1b2c3d4e5f60123456789abcdef0302.svg', 'Peripherals'),
('High-Precision Wireless Mouse', 'Ultra-lightweight wireless gaming and productivity mouse featuring a 26K DPI optical sensor, PTFE glide feet, and 80-hour battery life.', 3800.00, 24, 'a1b2c3d4e5f60123456789abcdef0303.svg', 'Peripherals'),
('4K Ultra-HD Pro Webcam', 'Streaming and video conferencing webcam with 4K glass optics, rapid autofocus, dual noise-reducing microphones, and a physical privacy shutter.', 8500.00, 15, 'a1b2c3d4e5f60123456789abcdef0304.svg', 'Peripherals'),
('Cardioid Studio USB Microphone', 'Plug-and-play desktop condenser microphone featuring tap-to-mute with LED indicator, gain control dial, zero-latency headphone monitoring, and shock mount.', 6900.00, 16, 'a1b2c3d4e5f60123456789abcdef0305.svg', 'Peripherals'),

-- Desk Setup
('Adjustable Aluminum Laptop Stand', 'Heavy-duty aircraft-grade aluminum folding laptop riser with dual-pivot height adjustment, silicone grip padding, and open airflow ventilation.', 3100.00, 30, 'a1b2c3d4e5f60123456789abcdef0401.svg', 'Desk Setup'),
('Minimalist Gas Spring Monitor Arm', 'Full-motion desktop monitor mount with smooth gas spring counterbalance, 360-degree rotation, VESA 75/100 bracket, and integrated cable management.', 5600.00, 18, 'a1b2c3d4e5f60123456789abcdef0402.svg', 'Desk Setup'),
('Dimmable LED Desk Lamp', 'Eye-care architectural desk lamp with 5 color temperatures, step-less touch dimming, flexible multi-angle swing arm, and memory recall.', 2800.00, 22, 'a1b2c3d4e5f60123456789abcdef0403.svg', 'Desk Setup'),
('Under-Desk Cable Management Tray', 'No-drill heavy-duty clamp cable organizer basket engineered to neatly route power strips, surge protectors, and workstation cables off the floor.', 1750.00, 25, 'a1b2c3d4e5f60123456789abcdef0404.svg', 'Desk Setup'),
('Dual-Sided Eco Leather Desk Pad', 'Generously sized (80x40cm) smooth-glide desk blotter made from premium water-resistant vegan leather with precision-stitched edges.', 1650.00, 40, 'a1b2c3d4e5f60123456789abcdef0405.svg', 'Desk Setup'),

-- Bags & Travel
('Commuter Tech Backpack (25L)', 'Weatherproof commuter backpack featuring a padded 16-inch laptop compartment, concealed anti-theft pocket, luggage strap, and quick-access organizer.', 4900.00, 22, 'a1b2c3d4e5f60123456789abcdef0501.svg', 'Bags & Travel'),
('Water-Resistant Laptop Sleeve', 'Padded protective sleeve with 360-degree shock-absorbing foam bumpers, plush fleece lining, and an exterior zippered accessory pouch for chargers.', 1700.00, 38, 'a1b2c3d4e5f60123456789abcdef0502.svg', 'Bags & Travel'),
('Travel Electronics Cable Pouch', 'Compact semi-rigid travel organizer with elastic retention bands, zip mesh compartments, and water-repellent shell for all cords and chargers.', 1350.00, 35, 'a1b2c3d4e5f60123456789abcdef0503.svg', 'Bags & Travel'),
('Canvas Everyday Market Tote', 'Heavyweight 16oz reinforced organic cotton canvas shopping tote with durable shoulder straps and interior zippered drop pocket.', 1100.00, 50, 'a1b2c3d4e5f60123456789abcdef0504.svg', 'Bags & Travel'),

-- Groceries
('Artisan Medium-Roast Coffee Beans', 'Single-origin washed arabica coffee beans roasted in small batches with tasting notes of chocolate truffle, toasted hazelnut, and sweet berry.', 1450.00, 40, 'a1b2c3d4e5f60123456789abcdef0601.svg', 'Groceries'),
('Ceremonial Matcha Green Tea (50g)', 'First-harvest shade-grown stone-ground Japanese ceremonial matcha, vibrant emerald green with a creamy, naturally sweet umami profile.', 2200.00, 25, 'a1b2c3d4e5f60123456789abcdef0602.svg', 'Groceries'),
('Pure Raw Forest Honey (500g)', 'Unpasteurized and cold-filtered raw forest wildflower honey rich in natural pollens and enzymes, harvested from local sustainable apiaries.', 950.00, 35, 'a1b2c3d4e5f60123456789abcdef0603.svg', 'Groceries'),
('Roasted Almonds & Sea Salt (350g)', 'Slow-roasted California whole almonds lightly seasoned with natural mineral sea salt; rich in plant protein, magnesium, and dietary fiber.', 1150.00, 45, 'a1b2c3d4e5f60123456789abcdef0604.svg', 'Groceries'),
('Artisanal Honey Oat Granola (400g)', 'Crunchy oven-toasted whole grain rolled oats with raw pumpkin seeds, sun-dried cranberries, almonds, and pure honey golden clusters.', 850.00, 50, 'a1b2c3d4e5f60123456789abcdef0605.svg', 'Groceries');
