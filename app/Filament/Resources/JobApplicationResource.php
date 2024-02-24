<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobApplicationResource\Pages;
use App\Filament\Resources\JobApplicationResource\RelationManagers;
use App\Models\JobApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JobApplicationResource extends Resource
{
    protected static ?string $model = JobApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'full_job_application_title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("jobApplicationCompany.title")
                    ->wrap(),
                Tables\Columns\TextColumn::make("jobApplicationRole.title")
                    ->wrap(),
                Tables\Columns\TextColumn::make('link')
                    ->url(fn ($record) => $record->link, true)
                    ->wrap(),
                Tables\Columns\TextColumn::make('date_applied')
                    ->description(
                        function(Model $record) {
                            return $record->age;
                        }
                    )
                    ->dateTime(),
                \Filament\Tables\Columns\TextColumn::make('salary_annual_min')
                    ->currency(function(Model $record) { return $record->salary_currency;  }),
                \Filament\Tables\Columns\TextColumn::make('salary_annual_max')
                    ->currency(function(Model $record) { return $record->salary_currency;  })

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListJobApplications::route('/'),
            'create' => Pages\CreateJobApplication::route('/create'),
            'edit' => Pages\EditJobApplication::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }
}
