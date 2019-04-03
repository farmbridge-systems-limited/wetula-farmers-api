<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/**
 * Farmer Info Table Factory of Fake data
 */
$factory->define(App\Models\FarmerInfo::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->unique()->numberBetween(1,50),
        'surname' => $faker->lastName,
        'first_name' => $faker->firstName,
        'middle_name' => strtoupper($faker->randomLetter),
        'nickname' => $faker->userName,
        'sex' => $faker->randomElement(['male', 'female']),
        'date_of_birth' => $faker->date(),
        'id_type' => 'Voters',
        'id_number' => $faker->creditCardNumber,
        'town_village_settlement' => $faker->streetName,
        'road_street_trace_Address' => $faker->streetAddress,
        'house_number' => 'BLK K47 PLT 300',
        'email' => $faker->email,
        'postal_office_box' => $faker->postcode,
        'postal_town_village_settlement' => $faker->streetName,
        'postal_street_road_trace_sentence' => $faker->streetAddress,
        'district_province' => $faker->city,
        'region' => $faker->randomElement(['ashanti', 'greater', 'volta']),
        'country' => $faker->country,
        'is_absentee_farmer' => $faker->boolean,
        'is_verified' => $faker->boolean,
        'date_verified' => $faker->date(),
        'photograph_url' => $faker->imageUrl(),
        'applicant_signage_url' => $faker->imageUrl()
    ];
});

/**
 * Farmer Enterprises fake seed data
 */
$factory->define(App\Models\FarmerEnterprise::class, function (Faker\Generator $faker) {
    return [
        'farmer_info_id' => $faker->numberBetween(1,50),
        'enterprise_id' => $faker->numberBetween(1,30),
        'engagement_status' => $faker->randomElement(['major', 'minor'])
    ];
});

/**
 * Farmer Lands fake seed data
 */
$factory->define(App\Models\Land::class, function (Faker\Generator $faker) {
    return [
        'farmer_info_id' => $faker->numberBetween(1,50),
        'verification_officer_id' => $faker->numberBetween(51,60),
        'address' => $faker->address,
        'size_area' => $faker->randomElement(['100x100', '500x500', '750x750']),
        'gps_address' => $faker->randomElement(['AS152541', 'BR241515', 'GT871524']),
        'region' => $faker->randomElement(['ashanti', 'volta', 'Brong-Ahafo', 'Central']),
        'district' => $faker->randomElement(['Ejura-Sekyedumase', 'Offinso West', 'Ashaiman North']),
        'locality' => $faker->randomElement(['Kyenkyenkura', 'Babaso', 'Nokwaresa']),
//        'applicable_tenure_code' => $faker->randomElement(['state rented', 'state leased',
//            'state occupied', 'state owned', 'private rented']),
        'is_tenureship_verified' => $faker->randomElement([true, false]),
        'are_documents_verified' => $faker->randomElement([true, false]),
        'remarks' => $faker->paragraph

    ];
});


/**
 * Farmer Land Documents fake seed data
 */
$factory->define(App\Models\LandDocument::class, function (Faker\Generator $faker) {
    return [
        'land_id' => $faker->numberBetween(1,500),
        'document_type' => $faker->randomElement(['lease', 'deed', 'agreement', 'rent Receipt', 'affidavit']),
        'document_url' => $faker->imageUrl()
    ];
});



/**
 * Farmers Bank Account Info fake seed data
 */
$factory->define(App\Models\BankInfo::class, function (Faker\Generator $faker) {
    return [
        'farmer_info_id' => $faker->unique(true)->numberBetween(1,50),
        'account_type' => $faker->randomElement(['Current Account', 'Savings Account','Fixed Account', 'Affidavit']),
        'account_name' => $faker->name,
        'account_number' => $faker->bankAccountNumber,
        'bic_swift_code' => $faker->swiftBicNumber,
        'bank_name' => $faker->randomElement(['Ghana Commercial Bank', 'Stanbic Bank',
            'Cal Bank', 'Prudential Bank', 'Standard Charted Bank', 'Access Bank',
            'Sekyedumase Rural Bank', 'Ejuraman Rural Bank']),
        'branch_name' => $faker->randomElement(['Ejura', 'Mampong', 'Effiduase', 'Adum', 'Sunyani', 'Accra']),
        'branch_address' => $faker->address,
        'bank_phone_number' => $faker->phoneNumber
    ];
});

