<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandTableSeeder extends Seeder
{
    protected $rows = Array(

        [1, "FORD"],
        [2, "CHEVROLETTE"],
        [3, "CHRYSLER"],
        [4, "CATERPILLAR"],
        [5, "MERCURY"],
        [6, "D100"],
        [7, "JEEP"],
        [8, "ISUZU"],
        [9, "HONDA"],
        [10, "TOYOTA"],
        [11, "DAIHATSU"],
        [12, "FIAT"],
        [13, "KODIAK"],
        [14, "DAEWOO"],
        [15, "SEAT"],
        [16, "LADA"],
        [17, "NISSAN"],
        [18, "RANGE"],
        [20, "MAZDA"],
        [21, "KIA"],
        [22, "REGNAULT"],
        [30, "KANO"],
        [31, "PEGASO"],
        [33, "IVECO"],
        [34, "PLYMOUNTH"],
        [35, "HYUNDAI"],
        [36, "EBRO"],
        [37, "SUZUKI"],
        [38, "MERCEDES BENZ"],
        [39, "MACK"],
        [40, "TITAN"],
        [41, "CADILLAC"],
        [42, "MITSUBISCHI"],
        [43, "VOLKSWAGEN"],
        [44, "ACADIAN"],
        [45, "LAND ROVER"],
        [46, "YAMAHA"],
        [47, "HILLAMN"],
        [50, "ENCABA"],
        [51, "COMMER"],
        [55, "PONTIAC"],
        [56, "CHANGHE"],
        [57, "SAAB"],
        [58, "CHANA"],
        [59, "GEELY"],
        [60, "REMYVECA"],
        [61, "CHERY"],
        [62, "YASUKY"],
        [63, "UNICO"],
        [64, "SHINERAY"],
        [65, "DACIA"],
        [66, "CARIBE"],
        [67, "JAC"],
        [68, "INTERNACIONAL"],
        [69, "PEUGEOT"],
        [70, "HUONIAO"],
        [71, "FREIGHTLINER"],
        [72, "VENIRAUTO"],
        [73, "CHUTO"],
        [74, "GREAT WALL"],
        [75, "WHITE"],
        [76, "CITROEN"],
        [77, "SAIC"],
        [78, "ALFA ROMEO"],
        [79, "BERA"],
        [80, "VOLVO"],
        [81, "QINGQI"],
        [82, "ROSSETTI"],
        [83, "FABR. EXTRANGERA"],
        [84, "HORSE"],
        [85, "TATA"],
        [86, "CONCORD"],
        [87, "KEEWAY"],
        [88, "JMC"],
        [89, "DONGFENG"],
        [90, "ROVER"],
        [91, "HAFEI"],
        [92, "ZOTYE"],
        [93, "HFC1061K"],
        [94, "FOTON"],
        [95, "BUICK"],
        [96, "LINCOLN"],
        [97, "MANAURE"],
        [98, "HATCH BACK"],
        [99, "GWM"],
        [100, "HUMMER"],
        [101, "DODGE"],
        [102, "MASTRO"],
        [103, "INBUS"],
        [104, "ORINOCO"],
        [105, "LUBEROWI"],
        [106, "G.M.C"],
        [107, "BMW"],
        [108, "WANGYE"],
        [109, "HAOJIANG"],
        [110, "SUBARU"],
        [111, "IVECO CAVALLINO"],
        [112, "BATEAS"],
        [113, "INPRODI"],
        [114, "RODO LINEA"],
        [115, "kawasaki"],
        [116, "HINO"],
        [118, "OPEL"],
        [119, "LEXUS"],
        [120, "MD HAOJIN"],
        [121, "YUEXIN"],
        [122, "HASTRO"],
        [123, "SUKIDA"],
        [124, "carrocerias atlas"],
        [125, "MD"],
        [126, "FAVOLCAR"],
        [127, "FABRICACION NAC"],
        [128, "SPILFER"],
        [129, "SKYGO"],
        [130, "YINGANG"],
        [131, "UNITED MOTORS"],
        [133, "FYM"],
        [134, "AVA"],
        [135, "BENELLI"],
        [136, "FORTA GOLDEN DRAGON"],
        [137, "AVILA"],
        [138, "ENDURO"],
        [139, "loncin"],
        [140, "SANYA"],
        [141, "FURGO ESTACAS"],
        [142, "skoda"],
        [143, "DONGBEN"],
        [144, "OLDSMOBILE"],
        [145, "EMPIRE"],
        [146, "HAOJUE"],
        [147, "CHASIS"],
        [148, "CHASIS 60160"],
        [149, "NEW LEON"],
        [150, "MOTO MARKET"],
        [151, "zuzuki"],
        [152, "TUNING"],
        [153, "KTC"],
        [154, "QIPAI"],
        [155, "HUALONG"],
        [156, "YAMAZAKI"],
        [157, "ZXMCO"],
        [158, "KINGTON LIYANG"],
        [159, "ROFERCA MOTOR"],
        [160, "AUTOGAGO"],
        [161, "ANDINO"],
        [162, "AUTOGAGO"],
        [163, "UTILITY"],
        [164, "INVERMETAL"],
        [165, "NEW JAGUAR"],
        [166, "RENAULT"],
        [167, "YUTONG BUS"],
        [168, "TINTAN"],
        [169, "XTZ250"],
        [170, "GREAT WALL"],
        [171, "VENTO"],
        [172, "QUE MOTO"],
        [173, "YUTONG BUS"],
        [174, "MITSUBISHI"],
        [175, "GIUSEMI"],
        [176, "UNIVERS"],
        [177, "YAMAHA"],
        [178, "RKV"],
        [179, "ASTRA"],
        [180, "HORSE KW-150"]
    );


    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        foreach ($this->rows as $row) {
            DB::table('brands')->insert([
                'id' => $row[0],
                'name' => $row[1]
            ]);
        }
    }
}