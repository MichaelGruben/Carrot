package de.itGarten.carrot

import androidx.room.ColumnInfo
import androidx.room.Entity
import androidx.room.PrimaryKey

@Entity
data class Recipe(
    @ColumnInfo val title: String,
    @ColumnInfo(name = "time_level") val timeLevel: Int,
    @PrimaryKey(autoGenerate = true) var rid: Long = 0,
)