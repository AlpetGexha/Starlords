<?php

namespace App\Spotlight;

use App\Models\User;
use LivewireUI\Spotlight\Spotlight;
use LivewireUI\Spotlight\SpotlightCommand;
use LivewireUI\Spotlight\SpotlightCommandDependencies;
use LivewireUI\Spotlight\SpotlightCommandDependency;
use LivewireUI\Spotlight\SpotlightSearchResult;

class SearchUser extends SpotlightCommand
{
    /**
     * This is the name of the command that will be shown in the Spotlight component.
     */
    protected string $name = 'User - Search';

    /**
     * This is the description of your command which will be shown besides the command name.
     */
    protected string $description = 'Search for users';

    /**
     * You can define any number of additional search terms (also known as synonyms)
     * to be used when searching for this command.
     */
    protected array $synonyms = [];

    /**
     * Defining dependencies is optional. If you don't have any dependencies you can remove this method.
     * Dependencies are asked from your user in the order you add the dependencies.
     */
    public function dependencies(): ?SpotlightCommandDependencies
    {
        return SpotlightCommandDependencies::collection()
            ->add(
                SpotlightCommandDependency::make('user')
                    ->setPlaceholder('Search for a user')
            );
    }

    public function searchUser($query)
    {
        return User::where('name', 'like', "%{$query}%")
            ->get()
            ->map(function (User $user) {
                // You must map your search result into SpotlightSearchResult objects
                return new SpotlightSearchResult(
                    $user->id,
                    $user->username(),
                    sprintf('Check Profile of %s', $user->username())
                );
            });
    }

    /**
     * When all dependencies have been resolved the execute method is called.
     * You can type-hint all resolved dependency you defined earlier.
     */
    public function execute(Spotlight $spotlight, User $user)
    {
        // dd($user);
        return to_route('profile.user.single', ['username' => $user->username()]);
    }

    /**
     * You can provide any custom logic you want to determine whether the
     * command will be shown in the Spotlight component. If you don't have any
     * logic you can remove this method. You can type-hint any dependencies you
     * need and they will be resolved from the container.
     */
    public function shouldBeShown(): bool
    {
        return true;
    }
}
