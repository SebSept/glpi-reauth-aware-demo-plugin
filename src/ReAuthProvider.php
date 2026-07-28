<?php

declare(strict_types=1);

namespace GlpiPlugin\Reauthdemo;

use Glpi\Security\ReAuth\InPlaceReAuthStrategy;
use Override;
use Symfony\Component\HttpFoundation\Request;

/**
 * Minimal re-authentication strategy provided by the reauthdemo plugin.
 *
 * For demonstration purposes it validates the user input against a hard-coded
 * secret. A real strategy would delegate to an external provider or a
 * per-user credential.
 */
class ReAuthProvider extends InPlaceReAuthStrategy
{
    /**
     * Demo secret expected by verify(). Replace with a real verification in
     * production use.
     */
    private const DEMO_SECRET = '1234';

    /**
     * The whole prompt form submission is passed, so a real strategy is free to read as
     * many fields as its verification needs. This demo only needs the single `user_input`
     * field rendered by its prompt template.
     */
    #[Override]
    public function verify(int $users_id, Request $request): bool
    {
        $user_input = (string) $request->request->get('user_input', '');

        return hash_equals(self::DEMO_SECRET, $user_input);
    }

    #[Override]
    public function isAvailable(int $users_id, int $entities_id = 0): bool
    {
        // Offered to every user for the demo.
        return true;
    }

    #[Override]
    public function getLabel(): string
    {
        return __('Demo re-authentication', 'reauthdemo');
    }

    #[Override]
    public function getPromptTemplate(): string
    {
        return '@reauthdemo/reauth/prompt.html.twig';
    }

    #[Override]
    public function getPriority(): int
    {
        return 180;
    }
}
