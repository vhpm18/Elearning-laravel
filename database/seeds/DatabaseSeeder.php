<?php

use App\Entities\Category;
use App\Entities\Course;
use App\Entities\Goal;
use App\Entities\Level;
use App\Entities\Requirement;
use App\Entities\Role;
use App\Entities\Student;
use App\Entities\Teacher;
use App\Entities\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Storage::deleteDirectory('courses');
        Storage::deleteDirectory('users');

        Storage::makeDirectory('courses');
        Storage::makeDirectory('users');

        factory(Role::class, 1)->create(['name' => 'admin']);
        factory(Role::class, 1)->create(['name' => 'teacher']);
        factory(Role::class, 1)->create(['name' => 'student']);

        factory(User::class, 1)->create([
            'role_id'  => Role::ADMIN,
            'name'     => 'admin',
            'email'    => 'admin@mail.com',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
            // secret

        ])->each(function (User $u) {
            factory(Student::class, 1)->create(['user_id' => $u->id]);
        });

        factory(User::class, 1)->create([
            'role_id'  => Role::STUDENT,
            'name'     => 'student',
            'email'    => 'student@mail.com',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
            // secret

        ])->each(function (User $u) {
            factory(Student::class, 1)->create(['user_id' => $u->id]);
        });

        factory(User::class, 50)->create()
            ->each(function (User $u) {
                factory(Student::class, 1)->create(['user_id' => $u->id]);
            });
        factory(User::class, 10)->create()
            ->each(function (User $u) {
                factory(Student::class, 1)->create(['user_id' => $u->id]);
                factory(Teacher::class, 1)->create(['user_id' => $u->id]);
            });

        factory(Level::class, 1)->create(['name' => 'Beginer']);
        factory(Level::class, 1)->create(['name' => 'Intermediate']);
        factory(Level::class, 1)->create(['name' => 'Advance']);
        factory(Category::class, 5)->create();

        factory(Course::class, 50)->create()
            ->each(function (Course $c) {
                $c->goal()->saveMany(factory(Goal::class, 2)->create());
                $c->requirements()->saveMany(factory(Requirement::class, 4)->create());
            });
        //DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
