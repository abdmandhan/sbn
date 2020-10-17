<?php

namespace Abdmandhan\Sbn\Database\seeders;

use Abdmandhan\Sbn\Models\Product;
use Abdmandhan\Sbn\Models\ProductType;
use Abdmandhan\Sbn\Models\YieldAccept;
use Abdmandhan\Sbn\Models\YieldType;
use DateTime;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SbnDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->product();
    }

    public function product()
    {
        //product type
        ProductType::insert([
            [
                'name'      => 'Surat Berharga Negara',
                'code'      => 'ORI',
                'image'     => 'https://i.ibb.co/KKHqrxV/ori.png'
            ],
            [
                'name'      => 'Sukuk Retail',
                'code'      => 'SR',
                'image'     => 'https://i.ibb.co/41mg1Vs/sukri.png'
            ],
            [
                'name'      => 'Savings Bond Ritel',
                'code'      => 'SBR',
                'image'     => 'https://i.ibb.co/kHZTLQw/sbr.png'
            ],
            [
                'name'      => 'Sukuk Tabungan',
                'code'      => 'ST',
                'image'     => 'https://i.ibb.co/PDNX868/st.png'
            ],
        ]);
        $product_types = ProductType::all()->toArray();
        //end product type

        //yield types
        YieldType::insert([
            [
                'name'  => 'Fixed',
                'desc'  => 'Tetap'
            ],
            [
                'name'  => 'Float',
                'desc'  => 'Mengambang dengan tingkat minimum'
            ],
        ]);
        $yield_types = YieldType::all()->toArray();
        //end yield

        //yield accept
        YieldAccept::insert([
            ['name'      => 'Bulanan'],
            ['name'      => 'Tahunan'],
        ]);
        $yield_accepts = YieldAccept::all()->toArray();
        //end yield accept

        $faker = Factory::create('id_ID');
        $row = 10;

        foreach ($product_types as $key => $value) {
            $product_type = $value;
            $yield_type = $yield_types[array_rand($yield_types, 1)];
            $yield_accept = $yield_accepts[array_rand($yield_accepts, 1)];

            $maturity_years = $faker->numberBetween(1, 30);

            $launch_date = $faker->dateTimeBetween('-10 years');
            $booking_start_date = ((clone $launch_date)->modify('+7 days'))->format('Y-m-d');
            $booking_end_date = ((clone $launch_date)->modify('+3 month'))->format('Y-m-d');
            $launch_date = (clone $launch_date)->format('Y-m-d');

            $redemption_start_date = (new DateTime($booking_end_date))->modify('+7 days');
            $redemption_end_date = (new DateTime($booking_end_date))->modify("+$maturity_years years");

            $total_asset = $faker->numberBetween(1000, 3000) * 10000000;
            $min_buy = $faker->numberBetween(1000, 3000) * 1000;
            $max_buy = $faker->numberBetween(1000, 3000) * 10000;

            $yield = $faker->randomFloat(2, 3, 8);
            $yield_high = $faker->randomFloat(2, $yield, 8);
            $yield_low = $faker->randomFloat(2, 3, $yield);

            $name = $product_type['code'] . '0' . $faker->numberBetween(1, 99);
            $data = [
                'product_type_id'           => $product_type['id'],
                'name'                      => $name,
                'desc'                      => $faker->paragraph(),
                'code'                      => $name,
                'total_asset'               => $total_asset,
                'frequence'                 => $faker->numberBetween(1, 25),
                'min_buy'                   => $min_buy,
                'max_buy'                   => $max_buy,
                'max_redemption_percent'    => $faker->numberBetween(80, 100),
                'yield_accept_id'           => $yield_accept['id'],
                'yield_type_id'             => $yield_type['id'],
                'yield'                     => $yield + 100,
                'yield_high'                => $yield_high + 100,
                'yield_low'                 => $yield_low + 100,
                'launch_date'               => $launch_date,
                'settlement_date'           => $booking_end_date,
                'booking_start_date'        => $booking_start_date,
                'booking_end_date'          => $booking_end_date,
                'redemption_start_date'     => $redemption_start_date,
                'redemption_end_date'       => $redemption_end_date,
                'buy_period'                => $booking_start_date . ' - ' . $booking_end_date,
                'maturity_years'            => $maturity_years,
                'is_trade'                  => 1,
                'is_syaria'                 => $faker->numberBetween(0, 1),
            ];

            Product::create($data);
        }
    }
}
