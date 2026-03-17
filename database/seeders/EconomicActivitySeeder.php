<?php

namespace Database\Seeders;

use App\Models\EconomicActivity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EconomicActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EconomicActivity::insert([

            // División 01
            ['economicactivity_number' => '0111', 'description_economicactivity' => 'Cultivo de cereales (excepto arroz), legumbres y semillas oleaginosas', 'category_id' => '01'],
            ['economicactivity_number' => '0112', 'description_economicactivity' => 'Cultivo de arroz', 'category_id' => '01'],
            ['economicactivity_number' => '0113', 'description_economicactivity' => 'Cultivo de hortalizas, raíces y tubérculos', 'category_id' => '01'],
            ['economicactivity_number' => '0114', 'description_economicactivity' => 'Cultivo de tabaco', 'category_id' => '01'],
            ['economicactivity_number' => '0115', 'description_economicactivity' => 'Cultivo de plantas textiles', 'category_id' => '01'],
            ['economicactivity_number' => '0119', 'description_economicactivity' => 'Otros cultivos transitorios n.c.p.', 'category_id' => '01'],
            ['economicactivity_number' => '0121', 'description_economicactivity' => 'Cultivo de frutas tropicales y subtropicales', 'category_id' => '01'],
            ['economicactivity_number' => '0122', 'description_economicactivity' => 'Cultivo de plátano y banano', 'category_id' => '01'],
            ['economicactivity_number' => '0123', 'description_economicactivity' => 'Cultivo de café', 'category_id' => '01'],
            ['economicactivity_number' => '0124', 'description_economicactivity' => 'Cultivo de caña de azúcar', 'category_id' => '01'],
            ['economicactivity_number' => '0125', 'description_economicactivity' => 'Cultivo de flor de corte', 'category_id' => '01'],
            ['economicactivity_number' => '0126', 'description_economicactivity' => 'Cultivo de palma para aceite (palma africana) y otros frutos oleaginosos', 'category_id' => '01'],
            ['economicactivity_number' => '0127', 'description_economicactivity' => 'Cultivo de plantas con las que se preparan bebidas', 'category_id' => '01'],
            ['economicactivity_number' => '0128', 'description_economicactivity' => 'Cultivo de especias y de plantas aromáticas y medicinales', 'category_id' => '01'],
            ['economicactivity_number' => '0129', 'description_economicactivity' => 'Otros cultivos permanentes n.c.p.', 'category_id' => '01'],
            ['economicactivity_number' => '0130', 'description_economicactivity' => 'Propagación de plantas (actividades de los viveros, excepto viveros forestales)', 'category_id' => '01'],
            ['economicactivity_number' => '0141', 'description_economicactivity' => 'Cría de ganado bovino y bufalino', 'category_id' => '01'],
            ['economicactivity_number' => '0142', 'description_economicactivity' => 'Cría de caballos y otros equinos', 'category_id' => '01'],
            ['economicactivity_number' => '0143', 'description_economicactivity' => 'Cría de ovejas y cabras', 'category_id' => '01'],
            ['economicactivity_number' => '0144', 'description_economicactivity' => 'Cría de ganado porcino', 'category_id' => '01'],
            ['economicactivity_number' => '0145', 'description_economicactivity' => 'Cría de aves de corral', 'category_id' => '01'],
            ['economicactivity_number' => '0149', 'description_economicactivity' => 'Cría de otros animales n.c.p.', 'category_id' => '01'],
            ['economicactivity_number' => '0150', 'description_economicactivity' => 'Explotación mixta (agrícola y pecuaria)', 'category_id' => '01'],
            ['economicactivity_number' => '0161', 'description_economicactivity' => 'Actividades de apoyo a la agricultura', 'category_id' => '01'],
            ['economicactivity_number' => '0162', 'description_economicactivity' => 'Actividades de apoyo a la ganadería', 'category_id' => '01'],
            ['economicactivity_number' => '0163', 'description_economicactivity' => 'Actividades posteriores a la cosecha', 'category_id' => '01'],
            ['economicactivity_number' => '0164', 'description_economicactivity' => 'Tratamiento de semillas para propagación', 'category_id' => '01'],
            ['economicactivity_number' => '0170', 'description_economicactivity' => 'Caza ordinaria y mediante trampas y actividades de servicios conexas', 'category_id' => '01'],

            // División 02
            ['economicactivity_number' => '0210', 'description_economicactivity' => 'Silvicultura y otras actividades forestales', 'category_id' => '02'],
            ['economicactivity_number' => '0220', 'description_economicactivity' => 'Extracción de madera', 'category_id' => '02'],
            ['economicactivity_number' => '0230', 'description_economicactivity' => 'Recolección de productos forestales diferentes a la madera', 'category_id' => '02'],
            ['economicactivity_number' => '0240', 'description_economicactivity' => 'Servicios de apoyo a la silvicultura', 'category_id' => '02'],

            // División 03
            ['economicactivity_number' => '0311', 'description_economicactivity' => 'Pesca marítima', 'category_id' => '03'],
            ['economicactivity_number' => '0312', 'description_economicactivity' => 'Pesca de agua dulce', 'category_id' => '03'],
            ['economicactivity_number' => '0321', 'description_economicactivity' => 'Acuicultura marítima', 'category_id' => '03'],
            ['economicactivity_number' => '0322', 'description_economicactivity' => 'Acuicultura de agua dulce', 'category_id' => '03'],

            // División 05
            ['economicactivity_number' => '0510', 'description_economicactivity' => 'Extracción de hulla (carbón de piedra)', 'category_id' => '05'],
            ['economicactivity_number' => '0520', 'description_economicactivity' => 'Extracción de carbón lignito', 'category_id' => '05'],

            // División 06
            ['economicactivity_number' => '0610', 'description_economicactivity' => 'Extracción de petróleo crudo', 'category_id' => '06'],
            ['economicactivity_number' => '0620', 'description_economicactivity' => 'Extracción de gas natural', 'category_id' => '06'],

            // División 07
            ['economicactivity_number' => '0710', 'description_economicactivity' => 'Extracción de minerales de hierro', 'category_id' => '07'],
            ['economicactivity_number' => '0721', 'description_economicactivity' => 'Extracción de minerales de uranio y de torio', 'category_id' => '07'],
            ['economicactivity_number' => '0722', 'description_economicactivity' => 'Extracción de oro y otros metales preciosos', 'category_id' => '07'],
            ['economicactivity_number' => '0723', 'description_economicactivity' => 'Extracción de minerales de níquel', 'category_id' => '07'],
            ['economicactivity_number' => '0729', 'description_economicactivity' => 'Extracción de otros minerales metalíferos no ferrosos n.c.p.', 'category_id' => '07'],

            // División 08
            ['economicactivity_number' => '0811', 'description_economicactivity' => 'Extracción de piedra, arena, arcillas comunes, yeso y anhidrita', 'category_id' => '08'],
            ['economicactivity_number' => '0812', 'description_economicactivity' => 'Extracción de arcillas de uso industrial, caliza, caolín y bentonitas', 'category_id' => '08'],
            ['economicactivity_number' => '0820', 'description_economicactivity' => 'Extracción de esmeraldas, piedras preciosas y semipreciosas', 'category_id' => '08'],
            ['economicactivity_number' => '0891', 'description_economicactivity' => 'Extracción de minerales para la fabricación de abonos y productos químicos', 'category_id' => '08'],
            ['economicactivity_number' => '0892', 'description_economicactivity' => 'Extracción de halita (sal)', 'category_id' => '08'],
            ['economicactivity_number' => '0899', 'description_economicactivity' => 'Extracción de otros minerales no metálicos n.c.p.', 'category_id' => '08'],

            // División 09
            ['economicactivity_number' => '0910', 'description_economicactivity' => 'Actividades de apoyo para la extracción de petróleo y de gas natural', 'category_id' => '09'],
            ['economicactivity_number' => '0990', 'description_economicactivity' => 'Actividades de apoyo para otras actividades de explotación de minas y canteras', 'category_id' => '09'],

            // División 10
            ['economicactivity_number' => '1011', 'description_economicactivity' => 'Procesamiento y conservación de carne y productos cárnicos', 'category_id' => '10'],
            ['economicactivity_number' => '1012', 'description_economicactivity' => 'Procesamiento y conservación de pescados, crustáceos y moluscos', 'category_id' => '10'],
            ['economicactivity_number' => '1020', 'description_economicactivity' => 'Procesamiento y conservación de frutas, legumbres, hortalizas y tubérculos', 'category_id' => '10'],
            ['economicactivity_number' => '1030', 'description_economicactivity' => 'Elaboración de aceites y grasas de origen vegetal y animal', 'category_id' => '10'],
            ['economicactivity_number' => '1040', 'description_economicactivity' => 'Elaboración de productos lácteos', 'category_id' => '10'],
            ['economicactivity_number' => '1051', 'description_economicactivity' => 'Elaboración de productos de molinería', 'category_id' => '10'],
            ['economicactivity_number' => '1052', 'description_economicactivity' => 'Elaboración de almidones y productos derivados del almidón', 'category_id' => '10'],
            ['economicactivity_number' => '1061', 'description_economicactivity' => 'Trilla de café', 'category_id' => '10'],
            ['economicactivity_number' => '1062', 'description_economicactivity' => 'Descafeinado, tostión y molienda del café', 'category_id' => '10'],
            ['economicactivity_number' => '1063', 'description_economicactivity' => 'Otros derivados del café', 'category_id' => '10'],
            ['economicactivity_number' => '1071', 'description_economicactivity' => 'Elaboración y refinación de azúcar', 'category_id' => '10'],
            ['economicactivity_number' => '1072', 'description_economicactivity' => 'Elaboración de panela', 'category_id' => '10'],
            ['economicactivity_number' => '1081', 'description_economicactivity' => 'Elaboración de productos de panadería', 'category_id' => '10'],
            ['economicactivity_number' => '1082', 'description_economicactivity' => 'Elaboración de cacao, chocolate y productos de confitería', 'category_id' => '10'],
            ['economicactivity_number' => '1083', 'description_economicactivity' => 'Elaboración de macarrones, fideos, alcuzcuz y productos farináceos similares', 'category_id' => '10'],
            ['economicactivity_number' => '1084', 'description_economicactivity' => 'Elaboración de comidas y platos preparados', 'category_id' => '10'],
            ['economicactivity_number' => '1089', 'description_economicactivity' => 'Elaboración de otros productos alimenticios n.c.p.', 'category_id' => '10'],
            ['economicactivity_number' => '1090', 'description_economicactivity' => 'Elaboración de alimentos preparados para animales', 'category_id' => '10'],

            // División 11
            ['economicactivity_number' => '1101', 'description_economicactivity' => 'Destilación, rectificación y mezcla de bebidas alcohólicas', 'category_id' => '11'],
            ['economicactivity_number' => '1102', 'description_economicactivity' => 'Elaboración de bebidas fermentadas no destiladas', 'category_id' => '11'],
            ['economicactivity_number' => '1103', 'description_economicactivity' => 'Producción de malta, elaboración de cervezas y otras bebidas malteadas', 'category_id' => '11'],
            ['economicactivity_number' => '1104', 'description_economicactivity' => 'Elaboración de bebidas no alcohólicas, producción de aguas minerales y de otras aguas embotelladas', 'category_id' => '11'],

            // División 12
            ['economicactivity_number' => '1200', 'description_economicactivity' => 'Elaboración de productos de tabaco', 'category_id' => '12'],

            // División 13
            ['economicactivity_number' => '1311', 'description_economicactivity' => 'Preparación e hilatura de fibras textiles', 'category_id' => '13'],
            ['economicactivity_number' => '1312', 'description_economicactivity' => 'Tejeduría de productos textiles', 'category_id' => '13'],
            ['economicactivity_number' => '1313', 'description_economicactivity' => 'Acabado de productos textiles', 'category_id' => '13'],
            ['economicactivity_number' => '1391', 'description_economicactivity' => 'Fabricación de tejidos de punto y ganchillo', 'category_id' => '13'],
            ['economicactivity_number' => '1392', 'description_economicactivity' => 'Confección de artículos con materiales textiles, excepto prendas de vestir', 'category_id' => '13'],
            ['economicactivity_number' => '1393', 'description_economicactivity' => 'Fabricación de tapetes y alfombras para pisos', 'category_id' => '13'],
            ['economicactivity_number' => '1394', 'description_economicactivity' => 'Fabricación de cuerdas, cordeles, cables, bramantes y redes', 'category_id' => '13'],
            ['economicactivity_number' => '1399', 'description_economicactivity' => 'Fabricación de otros artículos textiles n.c.p.', 'category_id' => '13'],

            ['economicactivity_number' => '1410', 'description_economicactivity' => 'Confección de prendas de vestir, excepto prendas de piel', 'category_id' => '14'],
            ['economicactivity_number' => '1420', 'description_economicactivity' => 'Fabricación de artículos de piel', 'category_id' => '14'],
            ['economicactivity_number' => '1430', 'description_economicactivity' => 'Fabricación de artículos de punto y ganchillo', 'category_id' => '14'],

            // División 15
            ['economicactivity_number' => '1511', 'description_economicactivity' => 'Curtido y recurtido de cueros; recurtido y teñido de pieles', 'category_id' => '15'],
            ['economicactivity_number' => '1512', 'description_economicactivity' => 'Fabricación de artículos de viaje, bolsos de mano y artículos similares elaborados en cuero. Elaboración de artículos de talabartería y guarnicionería', 'category_id' => '15'],
            ['economicactivity_number' => '1513', 'description_economicactivity' => 'Fabricación de artículos de viaje, bolsos de mano y artículos similares. Artículos de talabartería y guarnicionería elaborados en otros materiales', 'category_id' => '15'],
            ['economicactivity_number' => '1521', 'description_economicactivity' => 'Fabricación de calzado de cuero y piel, con cualquier tipo de suela', 'category_id' => '15'],
            ['economicactivity_number' => '1522', 'description_economicactivity' => 'Fabricación de otros tipos de calzado, excepto calzado de cuero y piel', 'category_id' => '15'],
            ['economicactivity_number' => '1523', 'description_economicactivity' => 'Fabricación de partes del calzado', 'category_id' => '15'],

            // División 16
            ['economicactivity_number' => '1610', 'description_economicactivity' => 'Aserrado, acepillado e impregnación de la madera', 'category_id' => '16'],
            ['economicactivity_number' => '1620', 'description_economicactivity' => 'Fabricación de hojas de madera para enchapado. Fabricación de tableros contrachapados, tableros laminados, tableros de partículas y otros tableros y paneles', 'category_id' => '16'],
            ['economicactivity_number' => '1630', 'description_economicactivity' => 'Fabricación de partes y piezas de madera, de carpintería y ebanistería para la construcción', 'category_id' => '16'],
            ['economicactivity_number' => '1640', 'description_economicactivity' => 'Fabricación de recipientes de madera', 'category_id' => '16'],
            ['economicactivity_number' => '1690', 'description_economicactivity' => 'Fabricación de otros productos de madera; fabricación de artículos de corcho, cestería y espartería', 'category_id' => '16'],

            // División 17
            ['economicactivity_number' => '1701', 'description_economicactivity' => 'Fabricación de pulpas (pastas) celulósicas; papel y cartón', 'category_id' => '17'],
            ['economicactivity_number' => '1702', 'description_economicactivity' => 'Fabricación de papel y cartón ondulado (corrugado); fabricación de envases, empaques y de embalajes de papel y cartón', 'category_id' => '17'],
            ['economicactivity_number' => '1709', 'description_economicactivity' => 'Fabricación de otros artículos de papel y cartón', 'category_id' => '17'],

            // División 18
            ['economicactivity_number' => '1811', 'description_economicactivity' => 'Actividades de impresión', 'category_id' => '18'],
            ['economicactivity_number' => '1812', 'description_economicactivity' => 'Actividades de servicios relacionados con la impresión', 'category_id' => '18'],
            ['economicactivity_number' => '1820', 'description_economicactivity' => 'Producción de copias a partir de grabaciones originales', 'category_id' => '18'],

            // División 19
            ['economicactivity_number' => '1910', 'description_economicactivity' => 'Fabricación de productos de hornos de coque', 'category_id' => '19'],
            ['economicactivity_number' => '1921', 'description_economicactivity' => 'Fabricación de productos de la refinación del petróleo', 'category_id' => '19'],
            ['economicactivity_number' => '1922', 'description_economicactivity' => 'Actividad de mezcla de combustibles', 'category_id' => '19'],

            // División 20
            ['economicactivity_number' => '2011', 'description_economicactivity' => 'Fabricación de sustancias y productos químicos básicos', 'category_id' => '20'],
            ['economicactivity_number' => '2012', 'description_economicactivity' => 'Fabricación de abonos y compuestos inorgánicos nitrogenados', 'category_id' => '20'],
            ['economicactivity_number' => '2013', 'description_economicactivity' => 'Fabricación de plásticos en formas primarias', 'category_id' => '20'],
            ['economicactivity_number' => '2014', 'description_economicactivity' => 'Fabricación de caucho sintético en formas primarias', 'category_id' => '20'],
            ['economicactivity_number' => '2021', 'description_economicactivity' => 'Fabricación de plaguicidas y otros productos químicos de uso agropecuario', 'category_id' => '20'],
            ['economicactivity_number' => '2022', 'description_economicactivity' => 'Fabricación de pinturas, barnices y revestimientos similares, tintas para impresión y masillas', 'category_id' => '20'],
            ['economicactivity_number' => '2023', 'description_economicactivity' => 'Fabricación de jabones y detergentes, preparados para limpiar y pulir; perfumes y preparados de tocador', 'category_id' => '20'],
            ['economicactivity_number' => '2029', 'description_economicactivity' => 'Fabricación de otros productos químicos n.c.p.', 'category_id' => '20'],
            ['economicactivity_number' => '2030', 'description_economicactivity' => 'Fabricación de fibras sintéticas y artificiales', 'category_id' => '20'],

            // División 21
            ['economicactivity_number' => '2100', 'description_economicactivity' => 'Fabricación de productos farmacéuticos, sustancias químicas medicinales y productos botánicos de uso farmacéutico', 'category_id' => '21'],

            // División 22
            ['economicactivity_number' => '2211', 'description_economicactivity' => 'Fabricación de llantas y neumáticos de caucho', 'category_id' => '22'],
            ['economicactivity_number' => '2212', 'description_economicactivity' => 'Reencauche de llantas usadas', 'category_id' => '22'],
            ['economicactivity_number' => '2219', 'description_economicactivity' => 'Fabricación de formas básicas de caucho y otros productos de caucho n.c.p.', 'category_id' => '22'],
            ['economicactivity_number' => '2221', 'description_economicactivity' => 'Fabricación de formas básicas de plástico', 'category_id' => '22'],
            ['economicactivity_number' => '2229', 'description_economicactivity' => 'Fabricación de artículos de plástico n.c.p.', 'category_id' => '22'],

            // División 23
            ['economicactivity_number' => '2310', 'description_economicactivity' => 'Fabricación de vidrio y productos de vidrio', 'category_id' => '23'],
            ['economicactivity_number' => '2391', 'description_economicactivity' => 'Fabricación de productos refractarios', 'category_id' => '23'],
            ['economicactivity_number' => '2392', 'description_economicactivity' => 'Fabricación de materiales de arcilla para la construcción', 'category_id' => '23'],
            ['economicactivity_number' => '2393', 'description_economicactivity' => 'Fabricación de otros productos de cerámica y porcelana', 'category_id' => '23'],
            ['economicactivity_number' => '2394', 'description_economicactivity' => 'Fabricación de cemento, cal y yeso', 'category_id' => '23'],
            ['economicactivity_number' => '2395', 'description_economicactivity' => 'Fabricación de artículos de hormigón, cemento y yeso', 'category_id' => '23'],
            ['economicactivity_number' => '2396', 'description_economicactivity' => 'Corte, tallado y acabado de la piedra', 'category_id' => '23'],
            ['economicactivity_number' => '2399', 'description_economicactivity' => 'Fabricación de otros productos minerales no metálicos n.c.p.', 'category_id' => '23'],

            // División 24
            ['economicactivity_number' => '2410', 'description_economicactivity' => 'Industrias básicas de hierro y de acero', 'category_id' => '24'],
            ['economicactivity_number' => '2421', 'description_economicactivity' => 'Industrias básicas de metales preciosos', 'category_id' => '24'],
            ['economicactivity_number' => '2429', 'description_economicactivity' => 'Industrias básicas de otros metales no ferrosos', 'category_id' => '24'],
            ['economicactivity_number' => '2431', 'description_economicactivity' => 'Fundición de hierro y de acero', 'category_id' => '24'],
            ['economicactivity_number' => '2432', 'description_economicactivity' => 'Fundición de metales no ferrosos', 'category_id' => '24'],

            // División 25
            ['economicactivity_number' => '2511', 'description_economicactivity' => 'Fabricación de productos metálicos para uso estructural', 'category_id' => '25'],
            ['economicactivity_number' => '2512', 'description_economicactivity' => 'Fabricación de tanques, depósitos y recipientes de metal, excepto los utilizados para el envase o transporte de mercancías', 'category_id' => '25'],
            ['economicactivity_number' => '2513', 'description_economicactivity' => 'Fabricación de generadores de vapor, excepto calderas de agua caliente para calefacción central', 'category_id' => '25'],
            ['economicactivity_number' => '2520', 'description_economicactivity' => 'Fabricación de armas y municiones', 'category_id' => '25'],
            ['economicactivity_number' => '2591', 'description_economicactivity' => 'Forja, prensado, estampado y laminado de metal; pulvimetalurgia', 'category_id' => '25'],
            ['economicactivity_number' => '2592', 'description_economicactivity' => 'Tratamiento y revestimiento de metales; mecanizado', 'category_id' => '25'],
            ['economicactivity_number' => '2593', 'description_economicactivity' => 'Fabricación de artículos de cuchillería, herramientas de mano y artículos de ferretería', 'category_id' => '25'],
            ['economicactivity_number' => '2599', 'description_economicactivity' => 'Fabricación de otros productos elaborados de metal n.c.p.', 'category_id' => '25'],

            // División 26
            ['economicactivity_number' => '2610', 'description_economicactivity' => 'Fabricación de componentes y tableros electrónicos', 'category_id' => '26'],
            ['economicactivity_number' => '2620', 'description_economicactivity' => 'Fabricación de computadoras y de equipo periférico', 'category_id' => '26'],
            ['economicactivity_number' => '2630', 'description_economicactivity' => 'Fabricación de equipos de comunicación', 'category_id' => '26'],
            ['economicactivity_number' => '2640', 'description_economicactivity' => 'Fabricación de aparatos electrónicos de consumo', 'category_id' => '26'],
            ['economicactivity_number' => '2651', 'description_economicactivity' => 'Fabricación de equipo de medición, prueba, navegación y control', 'category_id' => '26'],
            ['economicactivity_number' => '2652', 'description_economicactivity' => 'Fabricación de relojes', 'category_id' => '26'],
            ['economicactivity_number' => '2660', 'description_economicactivity' => 'Fabricación de equipo de irradiación y equipo electrónico de uso médico y terapéutico', 'category_id' => '26'],
            ['economicactivity_number' => '2670', 'description_economicactivity' => 'Fabricación de instrumentos ópticos y equipo fotográfico', 'category_id' => '26'],
            ['economicactivity_number' => '2680', 'description_economicactivity' => 'Fabricación de medios magnéticos y ópticos para almacenamiento de datos', 'category_id' => '26'],

            // División 27
            ['economicactivity_number' => '2711', 'description_economicactivity' => 'Fabricación de motores, generadores y transformadores eléctricos', 'category_id' => '27'],
            ['economicactivity_number' => '2712', 'description_economicactivity' => 'Fabricación de aparatos de distribución y control de la energía eléctrica', 'category_id' => '27'],
            ['economicactivity_number' => '2720', 'description_economicactivity' => 'Fabricación de pilas, baterías y acumuladores eléctricos', 'category_id' => '27'],
            ['economicactivity_number' => '2731', 'description_economicactivity' => 'Fabricación de hilos y cables eléctricos y de fibra óptica', 'category_id' => '27'],
            ['economicactivity_number' => '2732', 'description_economicactivity' => 'Fabricación de dispositivos de cableado', 'category_id' => '27'],
            ['economicactivity_number' => '2740', 'description_economicactivity' => 'Fabricación de equipos eléctricos de iluminación', 'category_id' => '27'],
            ['economicactivity_number' => '2750', 'description_economicactivity' => 'Fabricación de aparatos de uso doméstico', 'category_id' => '27'],
            ['economicactivity_number' => '2790', 'description_economicactivity' => 'Fabricación de otros tipos de equipo eléctrico n.c.p.', 'category_id' => '27'],

            // División 28
            ['economicactivity_number' => '2811', 'description_economicactivity' => 'Fabricación de motores, turbinas, y partes para motores de combustión interna', 'category_id' => '28'],
            ['economicactivity_number' => '2812', 'description_economicactivity' => 'Fabricación de equipos de potencia hidráulica y neumática', 'category_id' => '28'],
            ['economicactivity_number' => '2813', 'description_economicactivity' => 'Fabricación de otras bombas, compresores, grifos y válvulas', 'category_id' => '28'],
            ['economicactivity_number' => '2814', 'description_economicactivity' => 'Fabricación de cojinetes, engranajes, trenes de engranajes y piezas de transmisión', 'category_id' => '28'],
            ['economicactivity_number' => '2815', 'description_economicactivity' => 'Fabricación de hornos, hogares y quemadores industriales', 'category_id' => '28'],
            ['economicactivity_number' => '2816', 'description_economicactivity' => 'Fabricación de equipo de elevación y manipulación', 'category_id' => '28'],
            ['economicactivity_number' => '2817', 'description_economicactivity' => 'Fabricación de maquinaria y equipo de oficina (excepto computadoras y equipo periférico)', 'category_id' => '28'],
            ['economicactivity_number' => '2818', 'description_economicactivity' => 'Fabricación de herramientas manuales con motor', 'category_id' => '28'],
            ['economicactivity_number' => '2819', 'description_economicactivity' => 'Fabricación de otros tipos de maquinaria y equipo de uso general n.c.p.', 'category_id' => '28'],
            ['economicactivity_number' => '2821', 'description_economicactivity' => 'Fabricación de maquinaria agropecuaria y forestal', 'category_id' => '28'],
            ['economicactivity_number' => '2822', 'description_economicactivity' => 'Fabricación de máquinas formadoras de metal y de máquinas herramienta', 'category_id' => '28'],
            ['economicactivity_number' => '2823', 'description_economicactivity' => 'Fabricación de maquinaria para la metalurgia', 'category_id' => '28'],
            ['economicactivity_number' => '2824', 'description_economicactivity' => 'Fabricación de maquinaria para explotación de minas y canteras y para obras de construcción', 'category_id' => '28'],
            ['economicactivity_number' => '2825', 'description_economicactivity' => 'Fabricación de maquinaria para la elaboración de alimentos, bebidas y tabaco', 'category_id' => '28'],
            ['economicactivity_number' => '2826', 'description_economicactivity' => 'Fabricación de maquinaria para la elaboración de productos textiles, prendas de vestir y cueros', 'category_id' => '28'],
            ['economicactivity_number' => '2829', 'description_economicactivity' => 'Fabricación de otros tipos de maquinaria y equipo de uso especial n.c.p.', 'category_id' => '28'],

            // División 29
            ['economicactivity_number' => '2910', 'description_economicactivity' => 'Fabricación de vehículos automotores y sus motores', 'category_id' => '29'],
            ['economicactivity_number' => '2920', 'description_economicactivity' => 'Fabricación de carrocerías para vehículos automotores; fabricación de remolques y semirremolques', 'category_id' => '29'],
            ['economicactivity_number' => '2930', 'description_economicactivity' => 'Fabricación de partes, piezas (autopartes) y accesorios (lujos) para vehículos automotores', 'category_id' => '29'],

            // División 30
            ['economicactivity_number' => '3011', 'description_economicactivity' => 'Construcción de barcos y de estructuras flotantes', 'category_id' => '30'],
            ['economicactivity_number' => '3012', 'description_economicactivity' => 'Construcción de embarcaciones de recreo y deporte', 'category_id' => '30'],
            ['economicactivity_number' => '3020', 'description_economicactivity' => 'Fabricación de locomotoras y de material rodante para ferrocarriles', 'category_id' => '30'],
            ['economicactivity_number' => '3030', 'description_economicactivity' => 'Fabricación de aeronaves, naves espaciales y de maquinaria conexa', 'category_id' => '30'],
            ['economicactivity_number' => '3040', 'description_economicactivity' => 'Fabricación de vehículos militares de combate', 'category_id' => '30'],
            ['economicactivity_number' => '3091', 'description_economicactivity' => 'Fabricación de motocicletas', 'category_id' => '30'],
            ['economicactivity_number' => '3092', 'description_economicactivity' => 'Fabricación de bicicletas y de sillas de ruedas para personas con discapacidad', 'category_id' => '30'],
            ['economicactivity_number' => '3099', 'description_economicactivity' => 'Fabricación de otros tipos de equipo de transporte n.c.p.', 'category_id' => '30'],

            // División 31
            ['economicactivity_number' => '3110', 'description_economicactivity' => 'Fabricación de muebles', 'category_id' => '31'],
            ['economicactivity_number' => '3120', 'description_economicactivity' => 'Fabricación de colchones y somieres', 'category_id' => '31'],

            // División 32
            ['economicactivity_number' => '3210', 'description_economicactivity' => 'Fabricación de joyas, bisutería y artículos conexos', 'category_id' => '32'],
            ['economicactivity_number' => '3220', 'description_economicactivity' => 'Fabricación de instrumentos musicales', 'category_id' => '32'],
            ['economicactivity_number' => '3230', 'description_economicactivity' => 'Fabricación de artículos y equipo para la práctica del deporte', 'category_id' => '32'],
            ['economicactivity_number' => '3240', 'description_economicactivity' => 'Fabricación de juegos, juguetes y rompecabezas', 'category_id' => '32'],
            ['economicactivity_number' => '3250', 'description_economicactivity' => 'Fabricación de instrumentos, aparatos y materiales médicos y odontológicos (incluido mobiliario)', 'category_id' => '32'],
            ['economicactivity_number' => '3290', 'description_economicactivity' => 'Otras industrias manufactureras n.c.p.', 'category_id' => '32'],

            // División 33
            ['economicactivity_number' => '3311', 'description_economicactivity' => 'Mantenimiento y reparación especializado de productos elaborados en metal', 'category_id' => '33'],
            ['economicactivity_number' => '3312', 'description_economicactivity' => 'Mantenimiento y reparación especializado de maquinaria y equipo', 'category_id' => '33'],
            ['economicactivity_number' => '3313', 'description_economicactivity' => 'Mantenimiento y reparación especializado de equipo electrónico y óptico', 'category_id' => '33'],
            ['economicactivity_number' => '3314', 'description_economicactivity' => 'Mantenimiento y reparación especializado de equipo eléctrico', 'category_id' => '33'],
            ['economicactivity_number' => '3315', 'description_economicactivity' => 'Mantenimiento y reparación especializado de equipo de transporte, excepto los vehículos automotores, motocicletas y bicicletas', 'category_id' => '33'],
            ['economicactivity_number' => '3319', 'description_economicactivity' => 'Mantenimiento y reparación de otros tipos de equipos y sus componentes n.c.p.', 'category_id' => '33'],
            ['economicactivity_number' => '3320', 'description_economicactivity' => 'Instalación especializada de maquinaria y equipo industrial', 'category_id' => '33'],

            // División 35
            ['economicactivity_number' => '3511', 'description_economicactivity' => 'Generación de energía eléctrica', 'category_id' => '35'],
            ['economicactivity_number' => '3512', 'description_economicactivity' => 'Transmisión de energía eléctrica', 'category_id' => '35'],
            ['economicactivity_number' => '3513', 'description_economicactivity' => 'Distribución de energía eléctrica', 'category_id' => '35'],
            ['economicactivity_number' => '3514', 'description_economicactivity' => 'Comercialización de energía eléctrica', 'category_id' => '35'],
            ['economicactivity_number' => '3520', 'description_economicactivity' => 'Producción de gas; distribución de combustibles gaseosos por tuberías', 'category_id' => '35'],
            ['economicactivity_number' => '3530', 'description_economicactivity' => 'Suministro de vapor y aire acondicionado', 'category_id' => '35'],

            // División 36
            ['economicactivity_number' => '3600', 'description_economicactivity' => 'Captación, tratamiento y distribución de agua', 'category_id' => '36'],

            // División 37
            ['economicactivity_number' => '3700', 'description_economicactivity' => 'Evacuación y tratamiento de aguas residuales', 'category_id' => '37'],

            // División 38
            ['economicactivity_number' => '3811', 'description_economicactivity' => 'Recolección de desechos no peligrosos', 'category_id' => '38'],
            ['economicactivity_number' => '3812', 'description_economicactivity' => 'Recolección de desechos peligrosos', 'category_id' => '38'],
            ['economicactivity_number' => '3821', 'description_economicactivity' => 'Tratamiento y disposición de desechos no peligrosos', 'category_id' => '38'],
            ['economicactivity_number' => '3822', 'description_economicactivity' => 'Tratamiento y disposición de desechos peligrosos', 'category_id' => '38'],
            ['economicactivity_number' => '3830', 'description_economicactivity' => 'Recuperación de materiales', 'category_id' => '38'],

            // División 39
            ['economicactivity_number' => '3900', 'description_economicactivity' => 'Actividades de saneamiento ambiental y otros servicios de gestión de desechos', 'category_id' => '39'],

            // División 41
            ['economicactivity_number' => '4111', 'description_economicactivity' => 'Construcción de edificios residenciales', 'category_id' => '41'],
            ['economicactivity_number' => '4112', 'description_economicactivity' => 'Construcción de edificios no residenciales', 'category_id' => '41'],

            // División 42
            ['economicactivity_number' => '4210', 'description_economicactivity' => 'Construcción de carreteras y vías de ferrocarril', 'category_id' => '42'],
            ['economicactivity_number' => '4220', 'description_economicactivity' => 'Construcción de proyectos de servicio público', 'category_id' => '42'],
            ['economicactivity_number' => '4290', 'description_economicactivity' => 'Construcción de otras obras de ingeniería civil', 'category_id' => '42'],

            // División 43
            ['economicactivity_number' => '4311', 'description_economicactivity' => 'Demolición', 'category_id' => '43'],
            ['economicactivity_number' => '4312', 'description_economicactivity' => 'Preparación del terreno', 'category_id' => '43'],
            ['economicactivity_number' => '4321', 'description_economicactivity' => 'Instalaciones eléctricas', 'category_id' => '43'],
            ['economicactivity_number' => '4322', 'description_economicactivity' => 'Instalaciones de fontanería, calefacción y aire acondicionado', 'category_id' => '43'],
            ['economicactivity_number' => '4329', 'description_economicactivity' => 'Otras instalaciones especializadas', 'category_id' => '43'],
            ['economicactivity_number' => '4330', 'description_economicactivity' => 'Terminación y acabado de edificios y obras de ingeniería civil', 'category_id' => '43'],
            ['economicactivity_number' => '4390', 'description_economicactivity' => 'Otras actividades especializadas para la construcción de edificios y obras de ingeniería civil', 'category_id' => '43'],

            // División 45
            ['economicactivity_number' => '4511', 'description_economicactivity' => 'Comercio de vehículos automotores nuevos', 'category_id' => '45'],
            ['economicactivity_number' => '4512', 'description_economicactivity' => 'Comercio de vehículos automotores usados', 'category_id' => '45'],
            ['economicactivity_number' => '4520', 'description_economicactivity' => 'Mantenimiento y reparación de vehículos automotores', 'category_id' => '45'],
            ['economicactivity_number' => '4530', 'description_economicactivity' => 'Comercio de partes, piezas (autopartes) y accesorios (lujos) para vehículos automotores', 'category_id' => '45'],
            ['economicactivity_number' => '4541', 'description_economicactivity' => 'Comercio de motocicletas y de sus partes, piezas y accesorios', 'category_id' => '45'],
            ['economicactivity_number' => '4542', 'description_economicactivity' => 'Mantenimiento y reparación de motocicletas y de sus partes y piezas', 'category_id' => '45'],

            // División 46
            ['economicactivity_number' => '4610', 'description_economicactivity' => 'Comercio al por mayor a cambio de una retribución o por contrata', 'category_id' => '46'],
            ['economicactivity_number' => '4620', 'description_economicactivity' => 'Comercio al por mayor de materias primas agropecuarias; animales vivos', 'category_id' => '46'],
            ['economicactivity_number' => '4631', 'description_economicactivity' => 'Comercio al por mayor de productos alimenticios', 'category_id' => '46'],
            ['economicactivity_number' => '4632', 'description_economicactivity' => 'Comercio al por mayor de bebidas y tabaco', 'category_id' => '46'],
            ['economicactivity_number' => '4641', 'description_economicactivity' => 'Comercio al por mayor de productos textiles, productos confeccionados para uso doméstico', 'category_id' => '46'],
            ['economicactivity_number' => '4642', 'description_economicactivity' => 'Comercio al por mayor de prendas de vestir', 'category_id' => '46'],
            ['economicactivity_number' => '4643', 'description_economicactivity' => 'Comercio al por mayor de calzado', 'category_id' => '46'],
            ['economicactivity_number' => '4644', 'description_economicactivity' => 'Comercio al por mayor de aparatos y equipo de uso doméstico', 'category_id' => '46'],
            ['economicactivity_number' => '4645', 'description_economicactivity' => 'Comercio al por mayor de productos farmacéuticos, medicinales, cosméticos y de tocador', 'category_id' => '46'],
            ['economicactivity_number' => '4649', 'description_economicactivity' => 'Comercio al por mayor de otros utensilios domésticos n.c.p.', 'category_id' => '46'],
            ['economicactivity_number' => '4651', 'description_economicactivity' => 'Comercio al por mayor de computadores, equipo periférico y programas de informática', 'category_id' => '46'],
            ['economicactivity_number' => '4652', 'description_economicactivity' => 'Comercio al por mayor de equipo, partes y piezas electrónicos y de telecomunicaciones', 'category_id' => '46'],
            ['economicactivity_number' => '4653', 'description_economicactivity' => 'Comercio al por mayor de maquinaria y equipo agropecuarios', 'category_id' => '46'],
            ['economicactivity_number' => '4659', 'description_economicactivity' => 'Comercio al por mayor de otros tipos de maquinaria y equipo n.c.p.', 'category_id' => '46'],
            ['economicactivity_number' => '4661', 'description_economicactivity' => 'Comercio al por mayor de combustibles sólidos, líquidos, gaseosos y productos conexos', 'category_id' => '46'],
            ['economicactivity_number' => '4662', 'description_economicactivity' => 'Comercio al por mayor de metales y productos metalíferos', 'category_id' => '46'],
            ['economicactivity_number' => '4663', 'description_economicactivity' => 'Comercio al por mayor de materiales de construcción, artículos de ferretería, pinturas, productos de vidrio, equipo y materiales de fontanería y calefacción', 'category_id' => '46'],
            ['economicactivity_number' => '4664', 'description_economicactivity' => 'Comercio al por mayor de productos químicos básicos, cauchos y plásticos en formas primarias y productos químicos de uso agropecuario', 'category_id' => '46'],
            ['economicactivity_number' => '4665', 'description_economicactivity' => 'Comercio al por mayor de desperdicios, desechos y chatarra', 'category_id' => '46'],
            ['economicactivity_number' => '4669', 'description_economicactivity' => 'Comercio al por mayor de otros productos n.c.p.', 'category_id' => '46'],
            ['economicactivity_number' => '4690', 'description_economicactivity' => 'Comercio al por mayor no especializado', 'category_id' => '46'],

            // División 47
            ['economicactivity_number' => '4711', 'description_economicactivity' => 'Comercio al por menor en establecimientos no especializados con surtido compuesto principalmente por alimentos, bebidas o tabaco', 'category_id' => '47'],
            ['economicactivity_number' => '4719', 'description_economicactivity' => 'Comercio al por menor en establecimientos no especializados, con surtido compuesto principalmente por productos diferentes de alimentos (víveres en general), bebidas y tabaco', 'category_id' => '47'],
            ['economicactivity_number' => '4721', 'description_economicactivity' => 'Comercio al por menor de productos agrícolas para el consumo en establecimientos especializados', 'category_id' => '47'],
            ['economicactivity_number' => '4722', 'description_economicactivity' => 'Comercio al por menor de leche, productos lácteos y huevos, en establecimientos especializados', 'category_id' => '47'],
            ['economicactivity_number' => '4723', 'description_economicactivity' => 'Comercio al por menor de carnes (incluye aves de corral), productos cárnicos, pescados y productos de mar, en establecimientos especializados', 'category_id' => '47'],
            ['economicactivity_number' => '4724', 'description_economicactivity' => 'Comercio al por menor de bebidas y productos del tabaco, en establecimientos especializados', 'category_id' => '47'],
            ['economicactivity_number' => '4729', 'description_economicactivity' => 'Comercio al por menor de otros productos alimenticios n.c.p., en establecimientos especializados', 'category_id' => '47'],
            ['economicactivity_number' => '4731', 'description_economicactivity' => 'Comercio al por menor de combustible para automotores', 'category_id' => '47'],
            ['economicactivity_number' => '4732', 'description_economicactivity' => 'Comercio al por menor de lubricantes (aceites, grasas), aditivos y productos de limpieza para vehículos automotores', 'category_id' => '47'],
            ['economicactivity_number' => '4741', 'description_economicactivity' => 'Comercio al por menor de computadores, equipos periféricos, programas de informática y equipos de telecomunicaciones en establecimientos especializados', 'category_id' => '47'],
            ['economicactivity_number' => '4742', 'description_economicactivity' => 'Comercio al por menor de equipos y aparatos de sonido y de video, en establecimientos especializados', 'category_id' => '47'],
            ['economicactivity_number' => '4751', 'description_economicactivity' => 'Comercio al por menor de productos textiles en establecimientos especializados', 'category_id' => '47'],
            ['economicactivity_number' => '4752', 'description_economicactivity' => 'Comercio al por menor de artículos de ferretería, pinturas y productos de vidrio en establecimientos especializados', 'category_id' => '47'],
            ['economicactivity_number' => '4753', 'description_economicactivity' => 'Comercio al por menor de tapices, alfombras y cubrimientos para paredes y pisos en establecimientos especializados', 'category_id' => '47'],
            ['economicactivity_number' => '4754', 'description_economicactivity' => 'Comercio al por menor de electrodomésticos y gasodomésticos de uso doméstico, muebles y equipos de iluminación', 'category_id' => '47'],
            ['economicactivity_number' => '4755', 'description_economicactivity' => 'Comercio al por menor de artículos y utensilios de uso doméstico', 'category_id' => '47'],
            ['economicactivity_number' => '4759', 'description_economicactivity' => 'Comercio al por menor de otros artículos domésticos en establecimientos especializados', 'category_id' => '47'],
            ['economicactivity_number' => '4761', 'description_economicactivity' => 'Comercio al por menor de libros, periódicos, materiales y artículos de papelería y escritorio, en establecimientos especializados', 'category_id' => '47'],
            ['economicactivity_number' => '4762', 'description_economicactivity' => 'Comercio al por menor de artículos deportivos, en establecimientos especializados', 'category_id' => '47'],
            ['economicactivity_number' => '4769', 'description_economicactivity' => 'Comercio al por menor de otros artículos culturales y de entretenimiento n.c.p. en establecimientos especializados', 'category_id' => '47'],
            ['economicactivity_number' => '4771', 'description_economicactivity' => 'Comercio al por menor de prendas de vestir y sus accesorios (incluye artículos de piel) en establecimientos especializados', 'category_id' => '47'],
            ['economicactivity_number' => '4772', 'description_economicactivity' => 'Comercio al por menor de todo tipo de calzado y artículos de cuero y sucedáneos del cuero en establecimientos especializados', 'category_id' => '47'],
            ['economicactivity_number' => '4773', 'description_economicactivity' => 'Comercio al por menor de productos farmacéuticos y medicinales, cosméticos y artículos de tocador en establecimientos especializados', 'category_id' => '47'],
            ['economicactivity_number' => '4774', 'description_economicactivity' => 'Comercio al por menor de otros productos nuevos en establecimientos especializados', 'category_id' => '47'],
            ['economicactivity_number' => '4775', 'description_economicactivity' => 'Comercio al por menor de artículos de segunda mano', 'category_id' => '47'],
            ['economicactivity_number' => '4781', 'description_economicactivity' => 'Comercio al por menor de alimentos, bebidas y tabaco, en puestos de venta móviles', 'category_id' => '47'],
            ['economicactivity_number' => '4782', 'description_economicactivity' => 'Comercio al por menor de productos textiles, prendas de vestir y calzado, en puestos de venta móviles', 'category_id' => '47'],
            ['economicactivity_number' => '4789', 'description_economicactivity' => 'Comercio al por menor de otros productos en puestos de venta móviles', 'category_id' => '47'],
            ['economicactivity_number' => '4791', 'description_economicactivity' => 'Comercio al por menor realizado a través de Internet', 'category_id' => '47'],
            ['economicactivity_number' => '4792', 'description_economicactivity' => 'Comercio al por menor realizado a través de casas de venta o por correo', 'category_id' => '47'],
            ['economicactivity_number' => '4799', 'description_economicactivity' => 'Otros tipos de comercio al por menor no realizado en establecimientos, puestos de venta o mercados', 'category_id' => '47'],

            // División 49
            ['economicactivity_number' => '4911', 'description_economicactivity' => 'Transporte férreo de pasajeros', 'category_id' => '49'],
            ['economicactivity_number' => '4912', 'description_economicactivity' => 'Transporte férreo de carga', 'category_id' => '49'],
            ['economicactivity_number' => '4921', 'description_economicactivity' => 'Transporte de pasajeros', 'category_id' => '49'],
            ['economicactivity_number' => '4922', 'description_economicactivity' => 'Transporte mixto', 'category_id' => '49'],
            ['economicactivity_number' => '4923', 'description_economicactivity' => 'Transporte de carga por carretera', 'category_id' => '49'],
            ['economicactivity_number' => '4930', 'description_economicactivity' => 'Transporte por tuberías', 'category_id' => '49'],

            // División 50
            ['economicactivity_number' => '5011', 'description_economicactivity' => 'Transporte de pasajeros marítimo y de cabotaje', 'category_id' => '50'],
            ['economicactivity_number' => '5012', 'description_economicactivity' => 'Transporte de carga marítimo y de cabotaje', 'category_id' => '50'],
            ['economicactivity_number' => '5021', 'description_economicactivity' => 'Transporte fluvial de pasajeros', 'category_id' => '50'],
            ['economicactivity_number' => '5022', 'description_economicactivity' => 'Transporte fluvial de carga', 'category_id' => '50'],

            // División 51
            ['economicactivity_number' => '5111', 'description_economicactivity' => 'Transporte aéreo nacional de pasajeros', 'category_id' => '51'],
            ['economicactivity_number' => '5112', 'description_economicactivity' => 'Transporte aéreo internacional de pasajeros', 'category_id' => '51'],
            ['economicactivity_number' => '5121', 'description_economicactivity' => 'Transporte aéreo nacional de carga', 'category_id' => '51'],
            ['economicactivity_number' => '5122', 'description_economicactivity' => 'Transporte aéreo internacional de carga', 'category_id' => '51'],

            // División 52
            ['economicactivity_number' => '5210', 'description_economicactivity' => 'Almacenamiento y depósito', 'category_id' => '52'],
            ['economicactivity_number' => '5221', 'description_economicactivity' => 'Actividades de estaciones, vías y servicios complementarios para el transporte terrestre', 'category_id' => '52'],
            ['economicactivity_number' => '5222', 'description_economicactivity' => 'Actividades de puertos y servicios complementarios para el transporte acuático', 'category_id' => '52'],
            ['economicactivity_number' => '5223', 'description_economicactivity' => 'Actividades de aeropuertos, servicios de navegación aérea y demás actividades conexas al transporte aéreo', 'category_id' => '52'],
            ['economicactivity_number' => '5224', 'description_economicactivity' => 'Manipulación de carga', 'category_id' => '52'],
            ['economicactivity_number' => '5229', 'description_economicactivity' => 'Otras actividades complementarias al transporte', 'category_id' => '52'],

            // División 53
            ['economicactivity_number' => '5310', 'description_economicactivity' => 'Actividades postales nacionales', 'category_id' => '53'],
            ['economicactivity_number' => '5320', 'description_economicactivity' => 'Actividades de mensajería', 'category_id' => '53'],

            // División 55
            ['economicactivity_number' => '5511', 'description_economicactivity' => 'Alojamiento en hoteles', 'category_id' => '55'],
            ['economicactivity_number' => '5512', 'description_economicactivity' => 'Alojamiento en apartahoteles', 'category_id' => '55'],
            ['economicactivity_number' => '5513', 'description_economicactivity' => 'Alojamiento en centros vacacionales', 'category_id' => '55'],
            ['economicactivity_number' => '5514', 'description_economicactivity' => 'Alojamiento rural', 'category_id' => '55'],
            ['economicactivity_number' => '5519', 'description_economicactivity' => 'Otros tipos de alojamientos para visitantes', 'category_id' => '55'],
            ['economicactivity_number' => '5520', 'description_economicactivity' => 'Actividades de zonas de camping y parques para vehículos recreacionales', 'category_id' => '55'],
            ['economicactivity_number' => '5530', 'description_economicactivity' => 'Servicio por horas', 'category_id' => '55'],
            ['economicactivity_number' => '5590', 'description_economicactivity' => 'Otros tipos de alojamiento n.c.p.', 'category_id' => '55'],

            // División 56
            ['economicactivity_number' => '5611', 'description_economicactivity' => 'Expendio a la mesa de comidas preparadas', 'category_id' => '56'],
            ['economicactivity_number' => '5612', 'description_economicactivity' => 'Expendio por autoservicio de comidas preparadas', 'category_id' => '56'],
            ['economicactivity_number' => '5613', 'description_economicactivity' => 'Expendio de comidas preparadas en cafeterías', 'category_id' => '56'],
            ['economicactivity_number' => '5619', 'description_economicactivity' => 'Otros tipos de expendio de comidas preparadas n.c.p.', 'category_id' => '56'],
            ['economicactivity_number' => '5621', 'description_economicactivity' => 'Catering para eventos', 'category_id' => '56'],
            ['economicactivity_number' => '5629', 'description_economicactivity' => 'Actividades de otros servicios de comidas', 'category_id' => '56'],
            ['economicactivity_number' => '5630', 'description_economicactivity' => 'Expendio de bebidas alcohólicas para el consumo dentro del establecimiento', 'category_id' => '56'],

            // División 58
            ['economicactivity_number' => '5811', 'description_economicactivity' => 'Edición de libros', 'category_id' => '58'],
            ['economicactivity_number' => '5812', 'description_economicactivity' => 'Edición de directorios y listas de correo', 'category_id' => '58'],
            ['economicactivity_number' => '5813', 'description_economicactivity' => 'Edición de periódicos, revistas y otras publicaciones periódicas', 'category_id' => '58'],
            ['economicactivity_number' => '5819', 'description_economicactivity' => 'Otros trabajos de edición', 'category_id' => '58'],
            ['economicactivity_number' => '5820', 'description_economicactivity' => 'Edición de programas de informática (software)', 'category_id' => '58'],

            // División 59
            ['economicactivity_number' => '5911', 'description_economicactivity' => 'Actividades de producción de películas cinematográficas, videos, programas, anuncios y comerciales de televisión', 'category_id' => '59'],
            ['economicactivity_number' => '5912', 'description_economicactivity' => 'Actividades de posproducción de películas cinematográficas, videos, programas, anuncios y comerciales de televisión', 'category_id' => '59'],
            ['economicactivity_number' => '5913', 'description_economicactivity' => 'Actividades de distribución de películas cinematográficas, videos, programas, anuncios y comerciales de televisión', 'category_id' => '59'],
            ['economicactivity_number' => '5914', 'description_economicactivity' => 'Actividades de exhibición de películas cinematográficas y videos', 'category_id' => '59'],
            ['economicactivity_number' => '5920', 'description_economicactivity' => 'Actividades de grabación de sonido y edición de música', 'category_id' => '59'],

            // División 60
            ['economicactivity_number' => '6010', 'description_economicactivity' => 'Actividades de programación y transmisión en el servicio de radiodifusión sonora', 'category_id' => '60'],
            ['economicactivity_number' => '6020', 'description_economicactivity' => 'Actividades de programación y transmisión de televisión', 'category_id' => '60'],

            // División 61
            ['economicactivity_number' => '6110', 'description_economicactivity' => 'Actividades de telecomunicaciones alámbricas', 'category_id' => '61'],
            ['economicactivity_number' => '6120', 'description_economicactivity' => 'Actividades de telecomunicaciones inalámbricas', 'category_id' => '61'],
            ['economicactivity_number' => '6130', 'description_economicactivity' => 'Actividades de telecomunicación satelital', 'category_id' => '61'],
            ['economicactivity_number' => '6190', 'description_economicactivity' => 'Otras actividades de telecomunicaciones', 'category_id' => '61'],

            // División 62
            ['economicactivity_number' => '6201', 'description_economicactivity' => 'Actividades de desarrollo de sistemas informáticos (planificación, análisis, diseño, programación, pruebas)', 'category_id' => '62'],
            ['economicactivity_number' => '6202', 'description_economicactivity' => 'Actividades de consultoría informática y actividades de administración de instalaciones informáticas', 'category_id' => '62'],
            ['economicactivity_number' => '6209', 'description_economicactivity' => 'Otras actividades de tecnologías de información y actividades de servicios informáticos', 'category_id' => '62'],

            // División 63
            ['economicactivity_number' => '6311', 'description_economicactivity' => 'Procesamiento de datos, alojamiento (hosting) y actividades relacionadas', 'category_id' => '63'],
            ['economicactivity_number' => '6312', 'description_economicactivity' => 'Portales web', 'category_id' => '63'],
            ['economicactivity_number' => '6391', 'description_economicactivity' => 'Actividades de agencias de noticias', 'category_id' => '63'],
            ['economicactivity_number' => '6399', 'description_economicactivity' => 'Otras actividades de servicio de información n.c.p.', 'category_id' => '63'],

            // División 64
            ['economicactivity_number' => '6411', 'description_economicactivity' => 'Banco Central', 'category_id' => '64'],
            ['economicactivity_number' => '6412', 'description_economicactivity' => 'Bancos comerciales', 'category_id' => '64'],
            ['economicactivity_number' => '6421', 'description_economicactivity' => 'Actividades de las corporaciones financieras', 'category_id' => '64'],
            ['economicactivity_number' => '6422', 'description_economicactivity' => 'Actividades de las compañías de financiamiento', 'category_id' => '64'],
            ['economicactivity_number' => '6423', 'description_economicactivity' => 'Banca de segundo piso', 'category_id' => '64'],
            ['economicactivity_number' => '6424', 'description_economicactivity' => 'Actividades de las cooperativas financieras', 'category_id' => '64'],
            ['economicactivity_number' => '6431', 'description_economicactivity' => 'Fideicomisos, fondos y entidades financieras similares', 'category_id' => '64'],
            ['economicactivity_number' => '6432', 'description_economicactivity' => 'Fondos de cesantías', 'category_id' => '64'],
            ['economicactivity_number' => '6491', 'description_economicactivity' => 'Leasing financiero (arrendamiento financiero)', 'category_id' => '64'],
            ['economicactivity_number' => '6492', 'description_economicactivity' => 'Actividades financieras de fondos de empleados y otras formas asociativas del sector solidario', 'category_id' => '64'],
            ['economicactivity_number' => '6493', 'description_economicactivity' => 'Actividades de compra de cartera o factoring', 'category_id' => '64'],
            ['economicactivity_number' => '6494', 'description_economicactivity' => 'Otras actividades de distribución de fondos', 'category_id' => '64'],
            ['economicactivity_number' => '6495', 'description_economicactivity' => 'Instituciones especiales oficiales', 'category_id' => '64'],
            ['economicactivity_number' => '6499', 'description_economicactivity' => 'Otras actividades de servicio financiero, excepto las de seguros y pensiones n.c.p.', 'category_id' => '64'],

            // División 65
            ['economicactivity_number' => '6511', 'description_economicactivity' => 'Seguros generales', 'category_id' => '65'],
            ['economicactivity_number' => '6512', 'description_economicactivity' => 'Seguros de vida', 'category_id' => '65'],
            ['economicactivity_number' => '6513', 'description_economicactivity' => 'Reaseguros', 'category_id' => '65'],
            ['economicactivity_number' => '6514', 'description_economicactivity' => 'Capitalización', 'category_id' => '65'],
            ['economicactivity_number' => '6521', 'description_economicactivity' => 'Servicios de seguros sociales de salud', 'category_id' => '65'],
            ['economicactivity_number' => '6522', 'description_economicactivity' => 'Servicios de seguros sociales de riesgos profesionales', 'category_id' => '65'],
            ['economicactivity_number' => '6531', 'description_economicactivity' => 'Régimen de prima media con prestación definida (RPM)', 'category_id' => '65'],
            ['economicactivity_number' => '6532', 'description_economicactivity' => 'Régimen de ahorro individual (RAI)', 'category_id' => '65'],

            // División 66
            ['economicactivity_number' => '6611', 'description_economicactivity' => 'Administración de mercados financieros', 'category_id' => '66'],
            ['economicactivity_number' => '6612', 'description_economicactivity' => 'Corretaje de valores y de contratos de productos básicos', 'category_id' => '66'],
            ['economicactivity_number' => '6613', 'description_economicactivity' => 'Otras actividades relacionadas con el mercado de valores', 'category_id' => '66'],
            ['economicactivity_number' => '6614', 'description_economicactivity' => 'Actividades de las casas de cambio', 'category_id' => '66'],
            ['economicactivity_number' => '6615', 'description_economicactivity' => 'Actividades de los profesionales de compra y venta de divisas', 'category_id' => '66'],
            ['economicactivity_number' => '6619', 'description_economicactivity' => 'Otras actividades auxiliares de las actividades de servicios financieros n.c.p.', 'category_id' => '66'],
            ['economicactivity_number' => '6621', 'description_economicactivity' => 'Actividades de agentes y corredores de seguros', 'category_id' => '66'],
            ['economicactivity_number' => '6629', 'description_economicactivity' => 'Evaluación de riesgos y daños, y otras actividades de servicios auxiliares', 'category_id' => '66'],
            ['economicactivity_number' => '6630', 'description_economicactivity' => 'Actividades de administración de fondos', 'category_id' => '66'],

            // División 68
            ['economicactivity_number' => '6810', 'description_economicactivity' => 'Actividades inmobiliarias realizadas con bienes propios o arrendados', 'category_id' => '68'],
            ['economicactivity_number' => '6820', 'description_economicactivity' => 'Actividades inmobiliarias realizadas a cambio de una retribución o por contrata', 'category_id' => '68'],

            // División 69
            ['economicactivity_number' => '6910', 'description_economicactivity' => 'Actividades jurídicas', 'category_id' => '69'],
            ['economicactivity_number' => '6920', 'description_economicactivity' => 'Actividades de contabilidad, teneduría de libros, auditoría financiera y asesoría tributaria', 'category_id' => '69'],

            // División 70
            ['economicactivity_number' => '7010', 'description_economicactivity' => 'Actividades de administración empresarial', 'category_id' => '70'],
            ['economicactivity_number' => '7020', 'description_economicactivity' => 'Actividades de consultaría de gestión', 'category_id' => '70'],

            // División 71
            ['economicactivity_number' => '7110', 'description_economicactivity' => 'Actividades de arquitectura e ingeniería y otras actividades conexas de consultoría técnica', 'category_id' => '71'],
            ['economicactivity_number' => '7120', 'description_economicactivity' => 'Ensayos y análisis técnicos', 'category_id' => '71'],

            // División 72
            ['economicactivity_number' => '7210', 'description_economicactivity' => 'Investigaciones y desarrollo experimental en el campo de las ciencias naturales y la ingeniería', 'category_id' => '72'],
            ['economicactivity_number' => '7220', 'description_economicactivity' => 'Investigaciones y desarrollo experimental en el campo de las ciencias sociales y las humanidades', 'category_id' => '72'],

            // División 73
            ['economicactivity_number' => '7310', 'description_economicactivity' => 'Publicidad', 'category_id' => '73'],
            ['economicactivity_number' => '7320', 'description_economicactivity' => 'Estudios de mercado y realización de encuestas de opinión pública', 'category_id' => '73'],

            // División 74
            ['economicactivity_number' => '7410', 'description_economicactivity' => 'Actividades especializadas de diseño', 'category_id' => '74'],
            ['economicactivity_number' => '7420', 'description_economicactivity' => 'Actividades de fotografía', 'category_id' => '74'],
            ['economicactivity_number' => '7490', 'description_economicactivity' => 'Otras actividades profesionales, científicas y técnicas n.c.p.', 'category_id' => '74'],

            // División 75
            ['economicactivity_number' => '7500', 'description_economicactivity' => 'Actividades veterinarias', 'category_id' => '75'],

            // División 77
            ['economicactivity_number' => '7710', 'description_economicactivity' => 'Alquiler y arrendamiento de vehículos automotores', 'category_id' => '77'],
            ['economicactivity_number' => '7721', 'description_economicactivity' => 'Alquiler y arrendamiento de equipo recreativo y deportivo', 'category_id' => '77'],
            ['economicactivity_number' => '7722', 'description_economicactivity' => 'Alquiler de videos y discos', 'category_id' => '77'],
            ['economicactivity_number' => '7729', 'description_economicactivity' => 'Alquiler y arrendamiento de otros efectos personales y enseres domésticos n.c.p.', 'category_id' => '77'],
            ['economicactivity_number' => '7730', 'description_economicactivity' => 'Alquiler y arrendamiento de otros tipos de maquinaria, equipo y bienes tangibles n.c.p.', 'category_id' => '77'],
            ['economicactivity_number' => '7740', 'description_economicactivity' => 'Arrendamiento de propiedad intelectual y productos similares, excepto obras protegidas por derechos de autor', 'category_id' => '77'],

            // División 78
            ['economicactivity_number' => '7810', 'description_economicactivity' => 'Actividades de agencias de empleo', 'category_id' => '78'],
            ['economicactivity_number' => '7820', 'description_economicactivity' => 'Actividades de agencias de empleo temporal', 'category_id' => '78'],
            ['economicactivity_number' => '7830', 'description_economicactivity' => 'Otras actividades de suministro de recurso humano', 'category_id' => '78'],

            // División 79
            ['economicactivity_number' => '7911', 'description_economicactivity' => 'Actividades de las agencias de viaje', 'category_id' => '79'],
            ['economicactivity_number' => '7912', 'description_economicactivity' => 'Actividades de operadores turísticos', 'category_id' => '79'],
            ['economicactivity_number' => '7990', 'description_economicactivity' => 'Otros servicios de reserva y actividades relacionadas', 'category_id' => '79'],

            // División 80
            ['economicactivity_number' => '8010', 'description_economicactivity' => 'Actividades de seguridad privada', 'category_id' => '80'],
            ['economicactivity_number' => '8020', 'description_economicactivity' => 'Actividades de servicios de sistemas de seguridad', 'category_id' => '80'],
            ['economicactivity_number' => '8030', 'description_economicactivity' => 'Actividades de detectives e investigadores privados', 'category_id' => '80'],

            // División 81
            ['economicactivity_number' => '8110', 'description_economicactivity' => 'Actividades combinadas de apoyo a instalaciones', 'category_id' => '81'],
            ['economicactivity_number' => '8121', 'description_economicactivity' => 'Limpieza general interior de edificios', 'category_id' => '81'],
            ['economicactivity_number' => '8129', 'description_economicactivity' => 'Otras actividades de limpieza de edificios e instalaciones industriales', 'category_id' => '81'],
            ['economicactivity_number' => '8130', 'description_economicactivity' => 'Actividades de paisajismo y servicios de mantenimiento conexos', 'category_id' => '81'],

            // División 82
            ['economicactivity_number' => '8211', 'description_economicactivity' => 'Actividades combinadas de servicios administrativos de oficina', 'category_id' => '82'],
            ['economicactivity_number' => '8219', 'description_economicactivity' => 'Fotocopiado, preparación de documentos y otras actividades especializadas de apoyo a oficina', 'category_id' => '82'],
            ['economicactivity_number' => '8220', 'description_economicactivity' => 'Actividades de centros de llamadas (Call center)', 'category_id' => '82'],
            ['economicactivity_number' => '8230', 'description_economicactivity' => 'Organización de convenciones y eventos comerciales', 'category_id' => '82'],
            ['economicactivity_number' => '8291', 'description_economicactivity' => 'Actividades de agencias de cobranza y oficinas de calificación crediticia', 'category_id' => '82'],
            ['economicactivity_number' => '8292', 'description_economicactivity' => 'Actividades de envase y empaque', 'category_id' => '82'],
            ['economicactivity_number' => '8299', 'description_economicactivity' => 'Otras actividades de servicio de apoyo a las empresas n.c.p.', 'category_id' => '82'],

            // División 84
            ['economicactivity_number' => '8411', 'description_economicactivity' => 'Actividades legislativas de la administración pública', 'category_id' => '84'],
            ['economicactivity_number' => '8412', 'description_economicactivity' => 'Actividades ejecutivas de la administración pública', 'category_id' => '84'],
            ['economicactivity_number' => '8413', 'description_economicactivity' => 'Regulación de las actividades de organismos que prestan servicios de salud, educativos, culturales y otros servicios sociales, excepto servicios de seguridad social', 'category_id' => '84'],
            ['economicactivity_number' => '8414', 'description_economicactivity' => 'Actividades reguladoras y facilitadoras de la actividad económica', 'category_id' => '84'],
            ['economicactivity_number' => '8415', 'description_economicactivity' => 'Actividades de los otros órganos de control', 'category_id' => '84'],
            ['economicactivity_number' => '8421', 'description_economicactivity' => 'Relaciones exteriores', 'category_id' => '84'],
            ['economicactivity_number' => '8422', 'description_economicactivity' => 'Actividades de defensa', 'category_id' => '84'],
            ['economicactivity_number' => '8423', 'description_economicactivity' => 'Orden público y actividades de seguridad', 'category_id' => '84'],
            ['economicactivity_number' => '8424', 'description_economicactivity' => 'Administración de justicia', 'category_id' => '84'],
            ['economicactivity_number' => '8430', 'description_economicactivity' => 'Actividades de planes de seguridad social de afiliación obligatoria', 'category_id' => '84'],

            // División 85
            ['economicactivity_number' => '8511', 'description_economicactivity' => 'Educación de la primera infancia', 'category_id' => '85'],
            ['economicactivity_number' => '8512', 'description_economicactivity' => 'Educación preescolar', 'category_id' => '85'],
            ['economicactivity_number' => '8513', 'description_economicactivity' => 'Educación básica primaria', 'category_id' => '85'],
            ['economicactivity_number' => '8521', 'description_economicactivity' => 'Educación básica secundaria', 'category_id' => '85'],
            ['economicactivity_number' => '8522', 'description_economicactivity' => 'Educación media académica', 'category_id' => '85'],
            ['economicactivity_number' => '8523', 'description_economicactivity' => 'Educación media técnica y de formación laboral', 'category_id' => '85'],
            ['economicactivity_number' => '8530', 'description_economicactivity' => 'Establecimientos que combinan diferentes niveles de educación', 'category_id' => '85'],
            ['economicactivity_number' => '8541', 'description_economicactivity' => 'Educación técnica profesional', 'category_id' => '85'],
            ['economicactivity_number' => '8542', 'description_economicactivity' => 'Educación tecnológica', 'category_id' => '85'],
            ['economicactivity_number' => '8543', 'description_economicactivity' => 'Educación de instituciones universitarias o de escuelas tecnológicas', 'category_id' => '85'],
            ['economicactivity_number' => '8544', 'description_economicactivity' => 'Educación de universidades', 'category_id' => '85'],
            ['economicactivity_number' => '8551', 'description_economicactivity' => 'Formación académica no formal', 'category_id' => '85'],
            ['economicactivity_number' => '8552', 'description_economicactivity' => 'Enseñanza deportiva y recreativa', 'category_id' => '85'],
            ['economicactivity_number' => '8553', 'description_economicactivity' => 'Enseñanza cultural', 'category_id' => '85'],
            ['economicactivity_number' => '8559', 'description_economicactivity' => 'Otros tipos de educación n.c.p.', 'category_id' => '85'],
            ['economicactivity_number' => '8560', 'description_economicactivity' => 'Actividades de apoyo a la educación', 'category_id' => '85'],

            // División 86
            ['economicactivity_number' => '8610', 'description_economicactivity' => 'Actividades de hospitales y clínicas, con internación', 'category_id' => '86'],
            ['economicactivity_number' => '8621', 'description_economicactivity' => 'Actividades de la práctica médica, sin internación', 'category_id' => '86'],
            ['economicactivity_number' => '8622', 'description_economicactivity' => 'Actividades de la práctica odontológica', 'category_id' => '86'],
            ['economicactivity_number' => '8691', 'description_economicactivity' => 'Actividades de apoyo diagnóstico', 'category_id' => '86'],
            ['economicactivity_number' => '8692', 'description_economicactivity' => 'Actividades de apoyo terapéutico', 'category_id' => '86'],
            ['economicactivity_number' => '8699', 'description_economicactivity' => 'Otras actividades de atención de la salud humana', 'category_id' => '86'],

            // División 87
            ['economicactivity_number' => '8710', 'description_economicactivity' => 'Actividades de atención residencial medicalizada de tipo general', 'category_id' => '87'],
            ['economicactivity_number' => '8720', 'description_economicactivity' => 'Actividades de atención residencial, para el cuidado de pacientes con retardo mental, enfermedad mental y consumo de sustancias psicoactivas', 'category_id' => '87'],
            ['economicactivity_number' => '8730', 'description_economicactivity' => 'Actividades de atención en instituciones para el cuidado de personas mayores y/o discapacitadas', 'category_id' => '87'],
            ['economicactivity_number' => '8790', 'description_economicactivity' => 'Otras actividades de atención en instituciones con alojamiento', 'category_id' => '87'],

            // División 88
            ['economicactivity_number' => '8810', 'description_economicactivity' => 'Actividades de asistencia social sin alojamiento para personas mayores y discapacitadas', 'category_id' => '88'],
            ['economicactivity_number' => '8890', 'description_economicactivity' => 'Otras actividades de asistencia social sin alojamiento', 'category_id' => '88'],

            // División 90
            ['economicactivity_number' => '9001', 'description_economicactivity' => 'Creación literaria', 'category_id' => '90'],
            ['economicactivity_number' => '9002', 'description_economicactivity' => 'Creación musical', 'category_id' => '90'],
            ['economicactivity_number' => '9003', 'description_economicactivity' => 'Creación teatral', 'category_id' => '90'],
            ['economicactivity_number' => '9004', 'description_economicactivity' => 'Creación audiovisual', 'category_id' => '90'],
            ['economicactivity_number' => '9005', 'description_economicactivity' => 'Artes plásticas y visuales', 'category_id' => '90'],
            ['economicactivity_number' => '9006', 'description_economicactivity' => 'Actividades teatrales', 'category_id' => '90'],
            ['economicactivity_number' => '9007', 'description_economicactivity' => 'Actividades de espectáculos musicales en vivo', 'category_id' => '90'],
            ['economicactivity_number' => '9008', 'description_economicactivity' => 'Otras actividades de espectáculos en vivo', 'category_id' => '90'],

            // División 91
            ['economicactivity_number' => '9101', 'description_economicactivity' => 'Actividades de bibliotecas y archivos', 'category_id' => '91'],
            ['economicactivity_number' => '9102', 'description_economicactivity' => 'Actividades y funcionamiento de museos, conservación de edificios y sitios históricos', 'category_id' => '91'],
            ['economicactivity_number' => '9103', 'description_economicactivity' => 'Actividades de jardines botánicos, zoológicos y reservas naturales', 'category_id' => '91'],

            // División 92
            ['economicactivity_number' => '9200', 'description_economicactivity' => 'Actividades de juegos de azar y apuestas', 'category_id' => '92'],

            // División 93
            ['economicactivity_number' => '9311', 'description_economicactivity' => 'Gestión de instalaciones deportivas', 'category_id' => '93'],
            ['economicactivity_number' => '9312', 'description_economicactivity' => 'Actividades de clubes deportivos', 'category_id' => '93'],
            ['economicactivity_number' => '9319', 'description_economicactivity' => 'Otras actividades deportivas', 'category_id' => '93'],
            ['economicactivity_number' => '9321', 'description_economicactivity' => 'Actividades de parques de atracciones y parques temáticos', 'category_id' => '93'],
            ['economicactivity_number' => '9329', 'description_economicactivity' => 'Otras actividades recreativas y de esparcimiento n.c.p.', 'category_id' => '93'],

            // División 94
            ['economicactivity_number' => '9411', 'description_economicactivity' => 'Actividades de asociaciones empresariales y de empleadores', 'category_id' => '94'],
            ['economicactivity_number' => '9412', 'description_economicactivity' => 'Actividades de asociaciones profesionales', 'category_id' => '94'],
            ['economicactivity_number' => '9420', 'description_economicactivity' => 'Actividades de sindicatos de empleados', 'category_id' => '94'],
            ['economicactivity_number' => '9491', 'description_economicactivity' => 'Actividades de asociaciones religiosas', 'category_id' => '94'],
            ['economicactivity_number' => '9492', 'description_economicactivity' => 'Actividades de asociaciones políticas', 'category_id' => '94'],
            ['economicactivity_number' => '9499', 'description_economicactivity' => 'Actividades de otras asociaciones n.c.p.', 'category_id' => '94'],

            // División 95
            ['economicactivity_number' => '9511', 'description_economicactivity' => 'Mantenimiento y reparación de computadores y de equipo periférico', 'category_id' => '95'],
            ['economicactivity_number' => '9512', 'description_economicactivity' => 'Mantenimiento y reparación de equipos de comunicación', 'category_id' => '95'],
            ['economicactivity_number' => '9521', 'description_economicactivity' => 'Mantenimiento y reparación de aparatos electrónicos de consumo', 'category_id' => '95'],
            ['economicactivity_number' => '9522', 'description_economicactivity' => 'Mantenimiento y reparación de aparatos y equipos domésticos y de jardinería', 'category_id' => '95'],
            ['economicactivity_number' => '9523', 'description_economicactivity' => 'Reparación de calzado y artículos de cuero', 'category_id' => '95'],
            ['economicactivity_number' => '9524', 'description_economicactivity' => 'Reparación de muebles y accesorios para el hogar', 'category_id' => '95'],
            ['economicactivity_number' => '9529', 'description_economicactivity' => 'Mantenimiento y reparación de otros efectos personales y enseres domésticos', 'category_id' => '95'],

            // División 96
            ['economicactivity_number' => '9601', 'description_economicactivity' => 'Lavado y limpieza, incluso la limpieza en seco, de productos textiles y de piel', 'category_id' => '96'],
            ['economicactivity_number' => '9602', 'description_economicactivity' => 'Peluquería y otros tratamientos de belleza', 'category_id' => '96'],
            ['economicactivity_number' => '9603', 'description_economicactivity' => 'Pompas fúnebres y actividades relacionadas', 'category_id' => '96'],
            ['economicactivity_number' => '9609', 'description_economicactivity' => 'Otras actividades de servicios personales n.c.p.', 'category_id' => '96'],

            // División 97
            ['economicactivity_number' => '9700', 'description_economicactivity' => 'Actividades de los hogares individuales como empleadores de personal doméstico', 'category_id' => '97'],

            // División 98
            ['economicactivity_number' => '9810', 'description_economicactivity' => 'Actividades no diferenciadas de los hogares individuales como productores de bienes para uso propio', 'category_id' => '98'],
            ['economicactivity_number' => '9820', 'description_economicactivity' => 'Actividades no diferenciadas de los hogares individuales como productores de servicios para uso propio', 'category_id' => '98'],

            // División 99
            ['economicactivity_number' => '9900', 'description_economicactivity' => 'Actividades de organizaciones y entidades extraterritoriales', 'category_id' => '99'],

        ]);
    }
}
