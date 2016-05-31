<?php namespace App\Http\Middleware\RolesTrait;

use App\Http\Controllers\BaseFoundation\FlashMessages;
use App\Models\AdminUser;
use Closure;

trait Roles
{
    use FlashMessages;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $adminUser = new AdminUser();
        $loggedInUser = auth($adminUser->getGuard())->user();

        $adminCpAccess = \Config::get('app.adminCpAccess');

        if ($loggedInUser->status != 1) {
            $this->_setFlashMessage('Your account is disabled.', 'error');
            $this->_showFlashMessages();
            return redirect()->to($adminCpAccess . '/auth/login');
        }

        if (!$loggedInUser->adminUserRole || !$this->checkRole($loggedInUser->adminUserRole->slug)) {
            $this->_setFlashMessage('You need ' . $this->neededRole . ' role to access this page.', 'error');
            $this->_showFlashMessages();
            if (isset($this->redirectAdminPath)) {
                return redirect()->to($adminCpAccess . '/' . $this->redirectAdminPath);
            }
            return redirect()->to($adminCpAccess . '/dashboard');
        }

        return $next($request);
    }

    public function checkRole($currentRole = null)
    {
        if ($currentRole != $this->neededRole && !in_array($currentRole, $this->allowRole)) {
            return false;
        }
        return true;
    }
}
