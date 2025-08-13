// database/migrations/2025_08_13_000000_add_vote_count_to_cars.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (!Schema::hasColumn('cars', 'vote_count')) {
            Schema::table('cars', function (Blueprint $table) {
                $table->unsignedBigInteger('vote_count')->default(0)->after('checked_in');
            });
        }
    }
    public function down(): void {
        if (Schema::hasColumn('cars', 'vote_count')) {
            Schema::table('cars', function (Blueprint $table) {
                $table->dropColumn('vote_count');
            });
        }
    }
};
