use Illuminate\Support\Facades\DB;

$categories = DB::table('categories')
    ->leftJoin('category_translations', function($join) {
        $join->on('categories.id', '=', 'category_translations.category_id')
             ->where('category_translations.locale', '=', 'en');
    })
    ->select('categories.id', 'categories.parent_id', 'categories.status', 'category_translations.name')
    ->get();

foreach ($categories as $cat) {
    printf("ID: %d | Parent: %s | Status: %d | Name: %s\n", 
        $cat->id, 
        $cat->parent_id ?? 'NULL', 
        $cat->status, 
        $cat->name ?? 'N/A'
    );
}
