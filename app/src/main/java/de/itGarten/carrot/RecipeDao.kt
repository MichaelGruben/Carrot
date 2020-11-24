package de.itGarten.carrot

import androidx.room.*
import kotlinx.coroutines.flow.Flow

@Dao
interface RecipeDao {
    @Query("SELECT * FROM recipe")
    fun getAll(): Flow<List<Recipe>>

    @Query("SELECT * FROM recipe ORDER BY time_level,title ASC")
    fun getOrderedRecipes(): Flow<List<Recipe>>

    @Query("SELECT * FROM recipe WHERE title LIKE :title LIMIT 1")
    fun findByTitle(title: String): Recipe

    @Query("DELETE FROM recipe")
    suspend fun deleteAll()

    @Insert(onConflict = OnConflictStrategy.IGNORE)
    suspend fun insert(recipe: Recipe): Long
}
