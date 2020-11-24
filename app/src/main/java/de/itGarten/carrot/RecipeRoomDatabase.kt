package de.itGarten.carrot

import android.content.Context
import androidx.room.Database
import androidx.room.Room
import androidx.room.RoomDatabase
import androidx.sqlite.db.SupportSQLiteDatabase
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.launch

// Annotates class to be a Room Database with a table (entity) of the Recipe class
@Database(entities = arrayOf(Recipe::class), version = 1, exportSchema = false)
public abstract class RecipeRoomDatabase : RoomDatabase() {

    abstract fun recipeDao(): RecipeDao

    companion object {
        // Singleton prevents multiple instances of database opening at the
        // same time.
        @Volatile
        private var INSTANCE: RecipeRoomDatabase? = null

        fun getDatabase(context: Context, scope: CoroutineScope): RecipeRoomDatabase {
            // if the INSTANCE is not null, then return it,
            // if it is, then create the database
            return INSTANCE ?: synchronized(this) {
                val instance = Room.databaseBuilder(
                    context.applicationContext,
                    RecipeRoomDatabase::class.java,
                    "recipe_database"
                ).addCallback(RecipeDatabaseCallback(scope))
                    .build()
                INSTANCE = instance
                // return instance
                instance
            }
        }
    }

    private class RecipeDatabaseCallback(
        private val scope: CoroutineScope
    ) : RoomDatabase.Callback() {

        override fun onCreate(db: SupportSQLiteDatabase) {
            super.onCreate(db)
            INSTANCE?.let { database ->
                scope.launch {
                    populateDatabase(database.recipeDao())
                }
            }
        }

        suspend fun populateDatabase(recipeDao: RecipeDao) {
            // Delete all content here.
            recipeDao.deleteAll()

            // Add sample words.
            var recipe = Recipe("Flammkuchen", 1)
            recipeDao.insert(recipe)
            recipe = Recipe("Nudeln mit grünem Pesto",1)
            recipeDao.insert(recipe)
            recipe = Recipe("Halloumiburger",2)
            recipeDao.insert(recipe)
            recipe = Recipe("Bal-Nudeln",2)
            recipeDao.insert(recipe)
            recipe = Recipe("Nudeln mit Käs'",2)
            recipeDao.insert(recipe)
            recipe = Recipe("Vegetarischer Hering",2)
            recipeDao.insert(recipe)

            // TODO: Add your own recipes!
        }
    }

}
