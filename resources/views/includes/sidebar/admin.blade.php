<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="{{Request::is('admin')?'active':''}}">
        <a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> <span>@lang('app.dashboard')</span></a>
    </li>
    <li class="{{Request::is('admin/page*')?'active':''}} treeview">
      <a href="#">
        <i class="fa fa-globe"></i> <span>@lang('app.admin.pages')</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a class="{{Request::is('admin/page')?'active':''}}" href="{{route('admin.page.create')}}"><i class="fa fa-plus"></i>@lang('app.admin.page.add')</a></li>
        <li><a class="{{Request::is('admin/pages')?'active':''}}" href="{{route('admin.page.list', ['type'=>'page'])}}"><i class="fa fa-globe"></i>@lang('app.admin.page.list')</a></li>
        <li><a class="{{Request::is('admin/pubs')?'active':''}}"  href="{{route('admin.page.list', ['type'=>'pub'])}}"><i class="fa fa-columns"></i>@lang('app.admin.pub.list')</a></li>
        <li><a class="{{Request::is('admin/page/order')?'active':''}}" href="{{route('admin.page.order')}}"><i class="fa fa-list"></i>@lang('app.admin.page.order')</a></li>
      </ul>
    </li>
    <li class="{{Request::is('admin/blog*')?'active':''}} treeview">
      <a href="#">
        <i class="fa fa-cubes"></i> <span>@lang('app.admin.blogs')</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a class="{{Request::is('admin/blog')?'active':''}}" href="{{route('admin.blog.create')}}"><i class="fa fa-plus"></i>@lang('app.admin.blog.add')</a></li>
        <li><a class="{{Request::is('admin/blogs')?'active':''}}" href="{{route('admin.blog.list')}}"><i class="fa fa-circle-o"></i>@lang('app.admin.blog.list')</a></li>
        <li><a class="{{Request::is('admin/blogs/published')?'active':''}}" href="{{route('admin.blog.list', ['filter'=>'published'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.blog.publish')</a></li>
        <li><a class="{{Request::is('admin/blogs/pinged')?'active':''}}" href="{{route('admin.blog.list', ['filter'=>'pinged'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.blog.ping')</a></li>
        <li><a class="{{Request::is('admin/blogs/archived')?'active':''}}" href="{{route('admin.blog.list', ['filter'=>'archived'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.blog.archive')</a></li>
        <li><a class="{{Request::is('admin/blogs/trashed')?'active':''}}" href="{{route('admin.blog.list', ['filter'=>'trashed'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.blog.trash')</a></li>
      </ul>
    </li>
    <li class="{{Request::is('admin/categories/blog')?'active':''}}">
      <a href="{{route('admin.category.list', ['type'=>'blog'])}}">
        <i class="fa fa-th"></i> <span>@lang('app.admin.categories')</span>
      </a>
    </li>
    <li class="header text-aqua">SHOP</li>
    <li class="{{Request::is('admin/user*')?'active':''}} treeview">
      <a href="#">
        <i class="fa fa-users"></i> <span>@lang('app.users')</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a class="{{Request::is('admin/users')?'active':''}}" href="{{route('admin.user.list')}}"><i class="fa fa-circle-o"></i>Tous</a></li>
        <li><a class="{{Request::is('admin/users/admin')?'active':''}}" href="{{route('admin.user.list', ['filter'=>'admin'])}}"><i class="fa fa-circle-o"></i> Admin</a></li>
        <li><a class="{{Request::is('admin/users/seller')?'active':''}}" href="{{route('admin.user.list', ['filter'=>'seller'])}}"><i class="fa fa-circle-o"></i> Vendeurs</a></li>
        <li><a class="{{Request::is('admin/users/afa')?'active':''}}" href="{{route('admin.user.list', ['filter'=>'afa'])}}"><i class="fa fa-circle-o"></i> AFA</a></li>
        <li><a class="{{Request::is('admin/users/apl')?'active':''}}" href="{{route('admin.user.list', ['filter'=>'apl'])}}"><i class="fa fa-circle-o"></i> APL</a></li>
        <li><a class="{{Request::is('admin/users/member')?'active':''}}" href="{{route('admin.user.list', ['filter'=>'member'])}}"><i class="fa fa-circle-o"></i>Membres</a></li>
      </ul>
    </li>
    <li class="{{Request::is('admin/product*')?'active':''}} treeview">
      <a href="#">
        <i class="fa fa-shopping-cart"></i> <span>@lang('app.products')</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a class="{{Request::is('admin/products')?'active':''}}" href="{{route('admin.product.list')}}"><i class="fa fa-circle-o"></i>@lang('app.admin.product.list')</a></li>
        <li><a class="{{Request::is('admin/products/pinged')?'active':''}}" href="{{route('admin.product.list', ['filter'=>'pinged'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.product.ping')</a></li>
        <li><a class="{{Request::is('admin/products/published')?'active':''}}" href="{{route('admin.product.list', ['filter'=>'published'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.product.publish')</a></li>
        <li><a class="{{Request::is('admin/products/ordered')?'active':''}}" href="{{route('admin.product.list', ['filter'=>'ordered'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.product.ordered')</a></li>
        <li><a class="{{Request::is('admin/products/paid')?'active':''}}" href="{{route('admin.product.list', ['filter'=>'paid'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.product.paid')</a></li>
        <li><a class="{{Request::is('admin/products/archived')?'active':''}}" href="{{route('admin.product.list', ['filter'=>'archived'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.product.archive')</a></li>
      </ul>
    </li>
    <li class="{{Request::is('admin/categories/product')?'active':''}}">
      <a href="{{route('admin.category.list', ['type'=>'product'])}}">
        <i class="fa fa-th"></i> <span>@lang('app.admin.categories')</span>
      </a>
    </li>
    <li class="{{Request::is('admin/order*')?'active':''}} treeview">
      <a href="#">
        <i class="fa fa-shopping-bag"></i> <span>@lang('app.admin.orders')</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a class="{{Request::is('admin/orders')?'active':''}}" href="{{route('admin.order.list')}}"><i class="fa fa-circle-o"></i>@lang('app.admin.order.list')</a></li>
        <li><a class="{{Request::is('admin/orders/pinged')?'active':''}}" href="{{route('admin.order.list', ['filter'=>'pinged'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.order.pinged')</a></li>
        <li><a class="{{Request::is('admin/orders/ordered')?'active':''}}" href="{{route('admin.order.list', ['filter'=>'ordered'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.order.ordered')</a></li>
        <li><a class="{{Request::is('admin/orders/afa-not-received')?'active':''}}" href="{{route('admin.order.list', ['filter'=>'afa-not-received'])}}"><i class="fa fa-circle-o"></i>@lang('admin.commissions.not-received')</a></li>
        <li><a class="{{Request::is('admin/orders/afa-received')?'active':''}}" href="{{route('admin.order.list', ['filter'=>'afa-received'])}}"><i class="fa fa-circle-o"></i>@lang('admin.commissions.received')</a></li>
        <li><a class="{{Request::is('admin/orders/apl-not-paid')?'active':''}}" href="{{route('admin.order.list', ['filter'=>'apl-not-paid'])}}"><i class="fa fa-circle-o"></i>@lang('admin.commissions.not-paid')</a></li>
        <li><a class="{{Request::is('admin/orders/apl-paid')?'active':''}}" href="{{route('admin.order.list', ['filter'=>'apl-paid'])}}"><i class="fa fa-circle-o"></i>@lang('admin.commissions.paid')</a></li>
        <li><a class="{{Request::is('admin/orders/paid')?'active':''}}" href="{{route('admin.order.list', ['filter'=>'paid'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.order.paid')</a></li>
        <li><a class="{{Request::is('admin/orders/cancelled')?'active':''}}" href="{{route('admin.order.list', ['filter'=>'cancelled'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.order.cancelled')</a></li>
      </ul>
    </li>
    <li class="{{Request::is('admin/invoices*')?'active':''}} treeview">
      <a href="#">
        <i class="fa fa-shopping-cart"></i> <span>@lang('app.invoices')</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a class="{{Request::is('admin/invoices/reservation')?'active':''}}" href="{{route('admin.invoice.list', ['filter'=>'reservation'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.invoices.reservation')</a></li>
        <li><a class="{{Request::is('admin/invoices/tma')?'active':''}}" href="{{route('admin.invoice.list', ['filter'=>'tma'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.invoices.tma')</a></li>
        <li><a class="{{Request::is('admin/invoices/mio')?'active':''}}" href="{{route('admin.invoice.list', ['filter'=>'mio'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.invoices.mio')</a></li>
        <li><a class="{{Request::is('admin/invoices/cpc')?'active':''}}" href="{{route('admin.invoice.list', ['filter'=>'cpc'])}}"><i class="fa fa-circle-o"></i>@lang('app.admin.invoices.cpc')</a></li>
      </ul>
    </li>
    <li class="header">LOCALISATIONS</li>
    <li class="{{Request::is('admin/postalcode*')?'active':''}}">
      <a href="{{route('admin.postalcode.list')}}">
        <i class="fa fa-map-marker"></i> <span>@lang('app.admin.postalcodes')</span>
      </a>
    </li>
    <li class="{{Request::is('admin/state*')?'active':''}}">
      <a href="{{route('admin.state.list')}}">
        <i class="fa fa-map-signs"></i> <span>@lang('app.admin.states')</span>
      </a>
    </li>
    <li class="header">SYSTEMS</li>
    <li class="{{Request::is('admin/mails*')?'active':''}}">
      <a href="{{route('admin.mail.list', ['type'=>'inbox'])}}">
        <i class="fa fa-envelope"></i> <span>@lang('app.admin.mails')</span>
        <div class="notify" style="margin-right: 10px;"> <span class="heartbit"></span> <span class="point"></span> </div>
      </a>
    </li>
    <li class="{{Request::is('admin/badword*')?'active':''}}">
      <a href="{{route('admin.badword.list')}}">
        <i class="fa fa-leaf"></i> <span>@lang('app.admin.badwords')</span>
      </a>
    </li>
    <li class="{{Request::is('admin/plan*')?'active':''}}">
      <a href="{{route('admin.plan.list')}}">
        <i class="fa fa-bank"></i> <span>@lang('app.admin.plans')</span>
      </a>
    </li>
    <li class="header text-red">CONFIGS</li>
    <li class="{{Request::is('admin/config/site')?'active':''}}">
      <a href="{{route('config.site')}}">
        <i class="fa fa-desktop text-aqua"></i> <span>@lang('app.config.site')</span>
      </a>
    <li class="{{Request::is('admin/config/login')?'active':''}}">
      <a href="{{route('config.login')}}">
        <i class="fa fa-lock text-aqua"></i> <span>@lang('app.config.login')</span>
      </a>
    </li>
    <li class="{{Request::is('admin/config/social')?'active':''}}">
      <a href="{{route('config.social')}}">
        <i class="fa fa-snowflake-o text-aqua"></i> <span>@lang('app.config.social')</span>
      </a>
    </li>
    <li class="{{Request::is('admin/config/payment')?'active':''}}">
      <a href="{{route('config.payment')}}">
        <i class="fa fa-credit-card text-aqua"></i> <span>@lang('app.config.payment')</span>
      </a>
    </li>
  </ul>
</section>