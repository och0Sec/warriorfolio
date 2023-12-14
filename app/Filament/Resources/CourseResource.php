<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Course;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CourseResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CourseResource\RelationManagers;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'App Sections';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Course Information')
                    ->description('This information will be displayed publicly.')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('institution')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('start_date')
                            ->helperText('The day will not be displayed')
                            ->displayFormat('m/Y')
                            ->required(),
                        Forms\Components\DatePicker::make('end_date')
                            ->displayFormat('m/Y')
                            ->helperText('The day will not be displayed')
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'in progress' => 'In Progress',
                                'completed' => 'Completed',
                                'dropped' => 'Dropped',
                                'planned' => 'Planned',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('description')
                            ->maxLength(255),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable()
                    ->colors([
                        'primary',
                        'primary' => 'in progress',
                        'danger' => 'dropped',
                        'warning' => 'planned',
                        'success' => 'completed',
                    ])
                    ->icons([
                        'heroicon-o-check' => 'completed',
                        'heroicon-o-document' => 'planned',
                        'heroicon-o-x' => 'dropped',
                        'heroicon-o-pencil' => 'in progress',
                    ]),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('institution')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->sortable()
                    ->date('m/Y'),
                Tables\Columns\TextColumn::make('end_date')
                    ->sortable()
                    ->date('m/Y'),
            ])
            ->defaultSort('start_date', 'desc')
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
