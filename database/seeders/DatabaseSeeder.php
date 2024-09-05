<?php 
namespace Database\Seeders;

use App\Models\User;
use App\Models\Patientlist;
use App\Models\PaymentInfo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed users
        User::create([
            'usertype' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        
        User::create([
            'usertype' => 'patient',
            'name' => 'Patient',
            'email' => 'patient@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'usertype' => 'dentistrystudent',
            'name' => 'Dentistry Student',
            'email' => 'dentistrystudent@example.com',
            'password' => Hash::make('password'),
        ]);

        // Seed patient lists
       

        $patients = [
            ['name' => 'John Smith',
            'gender' => 'Male',
            'age' => 25,
            'phone' => '09123456789',
            'address' => '123 Maple Street'],
            ['name' => 'Emily Johnson',
            'gender' => 'Female',
            'age' => 21,
            'phone' => '09123456789',
            'address' => '456 El Street'],
            ['name' => 'Michael Rodriguez',
            'gender' => 'Male',
            'age' => 18,
            'phone' => '09123456789',
            'address' => '789 Oak Avenue'],
            ['name' => 'Sophia Brown',
            'gender' => 'Female',
            'age' => 23,
            'phone' => '09123456789',
            'address' => '101 Pine Lane'],
            ['name' => 'Liam Williams',
            'gender' => 'Male',
            'age' => 36,
            'phone' => '09123456789',
            'address' => '234 Birch Road'],
            ['name' => 'Emma Johnson',
            'gender' => 'Female',
            'age' => 29,
            'phone' => '09123456789',
            'address' => '123 Maple St, Springfield, IL'],
            ['name' => 'Alexander Lee',
            'gender' => 'Male',
            'age' => 41,
            'phone' => '09123456789',
            'address' => '789 Oak Ave, Charleston, SC'],
            ['name' => 'Sophia Martinez',
            'gender' => 'Female',
            'age' => 21,
            'phone' => '09123456789',
            'address' => '456 Pine Rd, Portland, OR'],
            ['name' => 'Noah Taylor',
            'gender' => 'Male',
            'age' => 33,
            'phone' => '09123456789',
            'address' => '567 Cedar Ln, Denver, CO'],
            ['name' => ' Olivia Brown',
            'gender' => 'Female',
            'age' => 27,
            'phone' => '09123456789',
            'address' => ' 890 Elm Blvd, Austin, TX'],
            ['name' => 'William Garcia',
            'gender' => 'Male',
            'age' => 39,
            'phone' => '09123456789',
            'address' => '234 Birch Dr, Nashville, TN'],
            ['name' => 'Ava Miller',
            'gender' => 'Female',
            'age' => 18,
            'phone' => '09123456789',
            'address' => '678 Aspen Way, Raleigh, NC'],
            ['name' => 'James Rodriguez',
            'gender' => 'Male',
            'age' => 24,
            'phone' => '09123456789',
            'address' => '345 Pinecrest Ave, Miami, FL'],
            ['name' => 'Isabella Wilson',
            'gender' => 'Male',
            'age' => 31,
            'phone' => '09123456789',
            'address' => '901 Magnolia Cir, Seattle, WA'],
            ['name' => 'Benjamin Thompson',
            'gender' => 'Male',
            'age' => 36,
            'phone' => '09123456789',
            'address' => '543 Willow St, San Francisco, CA'],
            ['name' => 'Mia Thomas',
            'gender' => 'Female',
            'age' => 24,
            'phone' => '09123456789',
            'address' => '789 Juniper Rd, Chicago, IL'],
            ['name' => 'Lucas Harris',
            'gender' => 'Male',
            'age' => 29,
            'phone' => '09123456789',
            'address' => '234 Spruce Ave, Boston, MA'],
            ['name' => 'Charlotte Davis',
            'gender' => 'Female',
            'age' => 28,
            'phone' => '09123456789',
            'address' => '456 Oakwood Blvd, Atlanta, GA'],
            ['name' => 'Mason Martinez',
            'gender' => 'Male',
            'age' => 20,
            'phone' => '09123456789',
            'address' => '678 Elmwood Dr, Houston, TX'],
            ['name' => 'Amelia Clark',
            'gender' => 'Male',
            'age' => 37,
            'phone' => '09123456789',
            'address' => '890 Maple Ave, Philadelphia, PA'],
            ['name' => 'Ethan White',
            'gender' => 'Male',
            'age' => 23,
            'phone' => '09123456789',
            'address' => '123 Birchwood Ln, Dallas, TX'],
            ['name' => 'Harper Robinson',
            'gender' => 'Male',
            'age' => 30,
            'phone' => '09123456789',
            'address' => '567 Cedar Rd, Los Angeles, CA']
        ];

        foreach ($patients as $patient) {
            Patientlist::create($patient);
        }

        // Seed payment info
        PaymentInfo::truncate();

        $payments = [
            ['patient' => 'Emily', 'description' => 'Cleaning', 'amount' => 11000, 'balance' => 2000, 'date' => '2024-02-28'],
            // Add more payments here...
            ['patient' => 'Olivia', 'description' => 'Orthodontic Treatment', 'amount' => 25000, 'balance' => 11000, 'date' => '2024-02-10'],
        ];

        foreach ($payments as $payment) {
            PaymentInfo::create($payment);
        }

       
    }
}
